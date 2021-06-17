<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Lang;
use App\Models\Admin\UsersModel;

class AccountController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $userModel = new UsersModel();
        $userData = $userModel->getOneUser($user->id);
        return view('customer.account', [
            'user_data' => $userData,
            'cartProducts' => $this->products,
            'head_title' => Lang::get('customer_pages.my_account'),
            'head_description' => Lang::get('customer_pages.my_account'),
        ]);
    }

    public function updateCustomer(Request $request) {
        $post = $request->all();
        $userModel = new UsersModel();
        $userModel->updateUser($post);
        $msg = Lang::get('customer_pages.user_is_updated');
        
        return redirect(lang_url('customer'))->with(['msg' => $msg, 'result' => true]);
    }

}
