<?php

namespace App\Models\Publics;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CheckoutModel extends Model
{

    private $post;

    public function setOrder($post)
    {
        $products = [];
        $i = 0;
        foreach ($post['id'] as $product_id) {
            $products[] = [
                'id' => $product_id,
                'quantity' => $post['quantity'][$i],
                'price' => $post['price'][$i],
                'product_size' => $post['product_size'][$i],
            ];
            $i++;
        }
        $this->post = $post;
        $this->post['products'] = $products;
        $order_id = DB::table('orders')->max('order_id');
        $this->post['order_id'] = $order_id + 1;
        DB::transaction(function () {
            $id = DB::table('orders')->insertGetId([
                'order_id' => $this->post['order_id'],
                'type' => $this->post['payment_transfer_type'],
                'products' => serialize($this->post['products'])
            ]);
            DB::table('orders_clients')->insert([
                'for_order' => $id,
                'user_id' => auth()->user()->id,
                'full_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'billing_address' => htmlspecialchars(trim($this->post['billing_address'])),
                'delivery_address' => htmlspecialchars(trim($this->post['delivery_address'])),
            ]);
        });
    }

    public function setFastOrder($post)
    {
        $this->post = $post;
        DB::table('fast_orders')->insert([
            'phone' => $this->post['fast_phone'],
            'names' => $this->post['fast_names']
        ]);
    }

}
