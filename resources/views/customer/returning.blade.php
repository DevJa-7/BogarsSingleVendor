@extends('layouts.app_public')

@section('content')
<div class="customer-body">

    <div class="container-large px-16 body-height">
        <div class="row px-16">
            <div class="col-sm-12">
                <h2>{{__('customer_pages.free_return')}}</h2>
                <span class="d-flex body-text op5 pt-16">{{__('customer_pages.free_return_description')}}</span>
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
                        <li class="active"> 
                            <a href="{{ lang_url('customer/returning') }}">
                                {{__('customer_pages.returning_on_items')}}
                            </a>
                        </li>
                        <li class=""> 
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
                <!-- 1. first part -->
                <div class="pt-32">
                    <h4>{{__('customer_pages.1_select_order')}}</h4>
                    <div class="row pt-16">
                        <div class="col-sm-3">
                            <span class="body-text op7">{{__('customer_pages.order_number')}}</span>
                        </div>
                        <div class="col-sm-9">
                            <span class="body-text">#_</span>
                        </div>
                    </div>
                </div>

                <!-- 2. second part -->
                <div class="pt-100">
                    <h4>{{__('customer_pages.2_prepare_package')}}</h4>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.return_your_items')}}</span>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.print_return_slip')}}</span>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.cut_paste_return_slip')}}</span>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.slide_other_part')}}</span>
                </div>

                <!-- 3. third part -->
                <div class="pt-100">
                    <h4>{{__('customer_pages.3_dropoff_package')}}</h4>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.tell_merchant')}}</span>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.have_him_sign_proof')}}</span>
                    <span class="d-flex body-text op7 pt-24">{{__('customer_pages.return_within_14_days')}}</span>
                    <span class="d-flex body-text op7 pt-32">{{__('customer_pages.return_costs_offered')}}</span>
                </div>

            </div>
        </div>
    </div>
  
</div>
@endsection

