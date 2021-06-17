<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Publics\ContactsController;
use App\Models\Admin\UsersModel;
use App\Models\Publics\CheckoutModel;

use Lang;
use App\Cart;
use PhpParser\Node\Expr\FuncCall;

class ChargeController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $userModel = new UsersModel();
        $userData = $userModel->getOneUser($user->id);

        return view('customer.charge', [
            'user_data' => $userData,
            'cartProducts' => $this->products,
            'head_title' => Lang::get('customer_pages.charge'),
            'head_description' => Lang::get('customer_pages.charge'),
        ]);
    }
    /**
     *  Pay with Stripe Payment Option
     */
    public function payWithStripe(Request $request) {
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        $secret_key = env('STRIPE_SANDBOX_SECRET_KEY');
        \Stripe\Stripe::setApiKey($secret_key);
       
        // Token is created using Stripe Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->stripeToken;
        $price = $request->total_price;
        try {
            $charge = \Stripe\Charge::create([
                'amount' => (float)$price * 100,
                'currency' => 'usd',
                'description' => 'Example charge',
                'source' => $token,
            ]);
        } catch (\Stripe\Error\Card $e) {
            // The card has been declined
        }

        // setorder
        $post = $request->all();
        $checkoutModel = new CheckoutModel();
        $checkoutModel->setOrder($post);
        $cart = new Cart();
        $cart->clearCart();

        $this->paymentConfirmEmail();

        return redirect(lang_url('customer/orders'))->with(['msg' => Lang::get('public_pages.order_accepted'), 'result' => true]);
    }

    public function payWithPayPal(Request $request) {
        
        $req = [];
        $req['billing_address'] = $request->get('billing_address');
        $req['delivery_address'] = $request->get('delivery_address');
        $req['payment_transfer_type'] = $request->get('payment_transfer_type');

        $_SESSION['payment_req'] = $req;

        $provider = new ExpressCheckout();
        $data = $this->getCheckoutData();

        try {
            $response = $provider->setExpressCheckout($data);
    
            if (isset($response['paypal_link'])) {
                return redirect($response['paypal_link']);
            } else {
                return redirect(lang_url('customer/orders'))->with(['msg' => Lang::get('customer_pages.payment_failed'), 'result' => true]);
            }
            
        } catch (\Exception $e) {
            return redirect(lang_url('customer/orders'))->with(['msg' => Lang::get('customer_pages.payment_error'), 'result' => true]);
        }
    }

    public function getCheckoutData() {
        $cartModel = new Cart();
        $cartProducts = $cartModel->getCartProducts();

        $data = [];
        $data['items'] = [];
        foreach ($cartProducts as $cartProduct) {
            $itemDetail = [
                'id' => $cartProduct->id,
                'name' => $cartProduct->name,
                'price' => $cartProduct->price,
                'qty' => $cartProduct->num_added,
                'product_size' => $cartProduct->product_size
            ];
            $data['items'][] = $itemDetail;
        }
        
        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Shopping in the Bogars";
        $data['return_url'] = url('paypalsuccess');
        $data['cancel_url'] = url('paypalcancel');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['subtotal'] = $total;
        $data['total'] = $total;

        return $data;
    }

    public function paypalSuccess(Request $request) {
        $provider = new ExpressCheckout();

        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        $cart = $this->getCheckoutData();
        $response = $provider->getExpressCheckoutDetails($token);
        
        $msg = '';
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $payment_status = $provider->doExpressCheckoutPayment($cart, $token, $PayerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
                $msg = Lang::get('customer_pages.paypal_success');
            } else {
                $msg = Lang::get('customer_pages.paypal_success_warning');
            }
        }
        
        // setorder
        $post = $cart;
        $post['id'] = [];
        $post['price'] = [];
        $post['quantity'] = [];
        
        foreach ($cart['items'] as $product) {
            $post['id'][] = $product['id'];
            $post['price'][] = $product['price'];
            $post['quantity'][] = $product['qty'];
            $post['product_size'][] = $product['product_size'];
        }
        unset($post['items']);

        if (isset($_SESSION['payment_req']) && !empty($_SESSION['payment_req'])) {
            $val = $_SESSION['payment_req'];
            $post['billing_address'] = $val['billing_address'];
            $post['delivery_address'] = $val['delivery_address'];
            $post['payment_transfer_type'] = $val['payment_transfer_type'];
        }
        
        // remove cookie
        unset($_SESSION['payment_req']);

        $checkoutModel = new CheckoutModel();
        $checkoutModel->setOrder($post);
        $cart = new Cart();
        $cart->clearCart();

        $this->paymentConfirmEmail();

        return redirect(lang_url('customer/orders'))->with(['msg' => $msg, 'result' => true]);
    }

    public function paypalCancel() {
        return 'PayPal payment is failed with some reason';
    }

    public function paymentConfirmEmail() {

        $contactController = new ContactsController();
        $user_email = auth()->user()->email;
        $user_name = auth()->user()->name;

        $contactController->sendPaymentConfirmEmail($user_email, $user_name);
    }
}
