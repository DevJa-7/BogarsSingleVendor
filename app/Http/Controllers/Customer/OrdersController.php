<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use App\Models\Admin\OrdersModel;
use App\Models\Publics\ProductsModel;

class OrdersController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getOrdersByUser($user->id);

        return view('customer.orders', [
            'cartProducts' => $this->products,
            'orders' => $orders,
            'controller' => $this,
            'head_title' => Lang::get('customer_pages.my_orders'),
            'head_description' => Lang::get('customer_pages.my_orders'),
        ]);
    }

    public function returnOrder(Request $request) {
        if (!$request->ajax()) {
            abort(404);
        }
        $post = $request->all();
        $ordersModel = new OrdersModel();
        $ordersModel->setNewStatus($post);
    }

    public function leaveReview(Request $request) {
        if (!$request->ajax()) {
            abort(404);
        }
        $post = $request->all();
        $ordersModel = new OrdersModel();
        $ordersModel->leaveReview($post);
    }

    public function changeStatus(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $post = $request->all();
        $ordersModel = new OrdersModel();
        $ordersModel->setNewStatus($post);
    }

    public function getProductInfo($id)
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->getProduct($id);
        return $product;
    }

}
