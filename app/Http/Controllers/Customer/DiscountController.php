<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Lang;
use App\Models\Admin\OrdersModel;


class DiscountController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->getOrders();

        return view('customer.discount', [
            'cartProducts' => $this->products,
            'orders' => $orders,
            'controller' => $this,
            'head_title' => Lang::get('customer_pages.my_discount_codes'),
            'head_description' => Lang::get('customer_pages.my_discount_codes'),
        ]);
    }

}
