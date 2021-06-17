@extends('layouts.app_public')

@section('content')
<div class="customer-body">

    <div class="container-large px-16 body-height">
        <div class="row px-16">
            <div class="col-sm-12">
                <h2>{{__('customer_pages.my_account')}}</h2>
            </div>
        </div>
        <div class="row pt-50">
            <div class="col-sm-2">
                <div class="list pt-0">
                    <ul class="parent">
                        <li class=""> 
                            <a href="{{ lang_url('customer/orders') }}">
                                {{__('customer_pages.my_orders')}}
                            </a>
                        </li>
                        <li class=""> 
                            <a href="{{ lang_url('customer/returns') }}">
                                {{__('customer_pages.my_returns')}}
                            </a>
                        </li>
                        <li class=""> 
                            <a href="{{ lang_url('customer/returning') }}">
                                {{__('customer_pages.returning_on_items')}}
                            </a>
                        </li>
                        <li class="active"> 
                            <a href="{{ lang_url('customer') }}">
                                {{__('customer_pages.personal_information')}}
                            </a>
                        </li>
                        <li class=""> 
                            <a href="{{ lang_url('customer/discount') }}">
                                {{__('customer_pages.my_discount_codes')}}
                            </a>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <form class="form-horizontal" method="POST" action="{{ lang_url('updateCustomer') }}">
                        {{ csrf_field() }}
                        <div class="col-sm-5">
                            <h4 class="text-transform-capitalize">{{__('customer_pages.personal_information')}}</h4>
                            
                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.account_type')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <span class="body-text">{{$user_data->type}}</span>
                                </div>
                            </div>

                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.id_user')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <span class="body-text">userID {{$user_data->id}}</span>
                                    <input type="hidden" value="{{$user_data->id}}" name="edit">
                                </div>
                            </div>

                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    <img src="{{asset('storage/edit.png')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.passwords')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <div class="cm-form p0">
                                        <input type="password" name="password">
                                    </div>
                                </div>
                            </div>

                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    <img src="{{asset('storage/edit.png')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.mail_address')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <div class="cm-form p0">
                                        <input type="text" name="email" value="{{$user_data->email}}" required autofocus>
                                    </div> 
                                    <!-- <span class="body-text">{{$user_data->email}}</span> -->
                                </div>
                            </div>

                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    <img src="{{asset('storage/edit.png')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.fullname')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <div class="cm-form p0">
                                        <input type="text" name="name" value="{{$user_data->name}}" required>
                                    </div> 
                                    <!-- <span class="body-text">{{$user_data->name}}</span> -->
                                </div>
                            </div>

                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    <img src="{{asset('storage/edit.png')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.billing_address')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <div class="cm-form p0">
                                        <input type="text" name="billing_address" value="{{$user_data->billing_address}}">
                                    </div> 
                                    <!-- <span class="body-text">32 Rue Boisnet 49100 Angers, FRANCE</span> -->
                                </div>
                            </div>

                            <div class="row pt-16">
                                <div class="col-sm-1">
                                    <img src="{{asset('storage/edit.png')}}">
                                </div>
                                <div class="col-sm-4">
                                    <span class="body-text op7">{{__('customer_pages.delivery_address')}}</span>
                                </div>
                                <div class="col-sm-7">
                                    <div class="cm-form p0">
                                        <input type="text" name="delivery_address" value="{{$user_data->delivery_address}}">
                                    </div> 
                                    <!-- <span class="body-text">32 Rue Boisnet 49100 Angers, FRANCE</span> -->
                                </div>
                            </div>

                            <div class="row pt-32">
                                <button type="submit" class="btn btn-primary px-32">
                                    {{__('customer_pages.save')}}
                                </button>
                            </div>

                        </div>
                    </form>
                    <div class="col-sm-7 pl-16">
                        <h4 class="text-transform-capitalize">{{__('customer_pages.payment_methods')}}</h4>
                        <div class="row pt-16">
                            <div class="col-sm-6">
                                <span class="body-text">{{__('customer_pages.credit_card')}}</span>
                            </div>
                            <div class="col-sm-6">
                                <span class="body-text">{{__('customer_pages.american_express')}}</span>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('storage/bank_card.png')}}" class="w-100 pr-16">
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('storage/express_card.png')}}" class="w-100 pr-16">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection

