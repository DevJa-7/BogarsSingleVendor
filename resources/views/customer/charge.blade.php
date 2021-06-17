@extends('layouts.app_public')

@section('content')

<div class="container">    
    <div class="div-center-middle body-height">
        <div class="row w-100">
            <div class="col-sm-12 div-center-middle">
                <!-- <h1>{{__('customer_pages.pay_to_us')}}</h1> -->
                <div class="auth-body">
                    @php
                    $sum = 0;
                    foreach($cartProducts as $cartProduct) {
                        $sum += $cartProduct->num_added * (float)$cartProduct->price;
                    }
                    @endphp
                    <h2 class="pb-32">{{__('customer_pages.price')}}: {{$sum}}€</h2>

                    <form action="{{lang_url('customer/charge')}}" method="POST" id="payment-form">
                        {{ csrf_field() }}
                        <div class="pt-8">
                            <div class="cm-form">
                                <label>{{__('customer_pages.billing_address')}}</label>
                                <input type="text" name="billing_address" 
                                    value="{{(isset($user_data->billing_address) && !empty($user_data->billing_address)) ? $user_data->billing_address : ''}}" required autofocus>
                            </div> 
                        </div>

                        <div class="pt-8">
                            <div class="cm-form">
                                <label>{{__('customer_pages.delivery_address')}}</label>
                                <input type="text" name="delivery_address" 
                                    value="{{(isset($user_data->delivery_address) && !empty($user_data->delivery_address)) ? $user_data->delivery_address : ''}}" required>
                            </div> 
                        </div>

                        <button type="button" onclick="paypalClicked()" class="btn btn-primary btn-lg btn-squared my-16">{{__('customer_pages.pay_paypal')}}</button>

                        @foreach($cartProducts as $cartProduct)
                        <input name="id[]" value="{{$cartProduct->id}}" type="hidden">
                        <input name="quantity[]" value="{{$cartProduct->num_added}}" type="hidden">
                        <input name="price[]" value="{{$cartProduct->price}}" type="hidden">
                        <input name="product_size[]" value="{{$cartProduct->product_size}}" type="hidden">
                        @endforeach

                        <div class="pt-8">
                            <div class="cm-form">
                                <input type="hidden" name="total_price" value="{{$sum}}">
                                <span class="separator body-text pb-8 w-100" card-element">
                                    {{__('customer_pages.or_pay_card')}}
                                </span>
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display Element errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>

                        <button type="button" onclick="stripeClicked()" class="btn btn-primary btn-lg btn-squared mt-16">{{__('customer_pages.pay_card')}}</button>
                        <button id="submitBtn" style="display:none;"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    $(document).ready(function() {
        var type_val = localStorage.getItem('payment_transfer_type');
        
        if (type_val == null || type_val.length <= 0) {
            type_val = 'standard';
        }
        $('#payment-form').append('\
            <input type="hidden" name="payment_transfer_type" value="' + type_val + '"> \
        ');
    });
</script>
@endsection
