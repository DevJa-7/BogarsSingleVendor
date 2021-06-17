<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Lang;
use App\Models\Admin\OrdersModel;

class ReturningController extends Controller
{

    public function index()
    {
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getOrders();
        
        return view('customer.returning', [
            'cartProducts' => $this->products,
            'orders' => $orders,
            'controller' => $this,
            'head_title' => Lang::get('customer_pages.returning_on_items'),
            'head_description' => Lang::get('customer_pages.returning_on_items'),
        ]);
    }

}
