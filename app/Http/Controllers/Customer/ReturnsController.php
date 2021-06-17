<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Lang;
use App\Models\Admin\OrdersModel;
use App\Models\Publics\ProductsModel;

class ReturnsController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getReturnOrdersByUser($user->id);
        
        return view('customer.returns', [
            'cartProducts' => $this->products,
            'orders' => $orders,
            'controller' => $this,
            'head_title' => Lang::get('customer_pages.my_returns'),
            'head_description' => Lang::get('customer_pages.my_returns'),
        ]);
    }

    public function getProductInfo($id)
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->getProduct($id);
        return $product;
    }

}
