@extends('layouts.app_public')

@section('content')
<div class="customer-body">

    <div class="container-large px-16 body-height">
        <div class="row px-16">
            <div class="col-sm-12">
                <h2>{{__('customer_pages.my_discount_codes')}}</h2>
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
                        <li class=""> 
                            <a href="{{ lang_url('customer') }}">
                                {{__('customer_pages.personal_information')}}
                            </a>
                        </li>
                        <li class="active"> 
                            <a href="{{ lang_url('customer/discount') }}">
                                {{__('customer_pages.my_discount_codes')}}
                            </a>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>{{__('customer_pages.banking_assets')}}</h4>
                        <div class="row">
                            there should be banking assets table !!!!
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>{{__('customer_pages.discount_loyalties')}}</h4>
                        <div class="row">
                            there should be discount & loyalities table !!!!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection

