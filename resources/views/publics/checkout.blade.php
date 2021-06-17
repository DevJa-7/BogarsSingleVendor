@extends('layouts.app_public')

@section('content')

<div class="customer-body">

    <div class="container body-height">
        <div class="row px-16">
            <div class="col-sm-12">
                <h2>{{__('public_pages.your_cart')}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="{{lang_url('checkout')}}" id="set-order"> 
                    {{ csrf_field() }}
                    <div class="products-for-checkout">
                        @php
                        $sum = $sum_total = 0;
                        if(!empty($cartProducts)) {
                        $sum = 0;
                        @endphp
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('public_pages.item')}}</th>
                                    <th scope="col">{{__('public_pages.item_name')}}</th>
                                    <th scope="col">{{__('public_pages.item_size')}}</th>
                                    <th scope="col">{{__('public_pages.item_quantity')}}</th>
                                    <th scope="col">{{__('public_pages.item_price')}}</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartProducts as $cartProduct)
                                @php
                                $sum_total += $cartProduct->num_added * (float)$cartProduct->price;
                                $sum = $cartProduct->num_added * (float)$cartProduct->price;
                                @endphp
                                <tr>
                                    <td>
                                        <input name="id[]" value="{{$cartProduct->id}}" type="hidden">
                                        <input name="quantity[]" value="{{$cartProduct->num_added}}" type="hidden">
                                        <input name="price[]" value="{{$cartProduct->price}}" type="hidden">
                                        <a href="{{lang_url($cartProduct->url)}}" class="link">                                        
                                            <img src="{{asset('storage/'.$cartProduct->image)}}" alt="">
                                        </a>
                                    </td>
                                    <td class="product-name w-30">
                                        <h4>{{$cartProduct->name}}</h4>
                                        <span class="comment">{{__('public_pages.made_in')}}&nbsp;{{$cartProduct->made_country}}</span>
                                        <span class="d-flex small-text grey-color pt-2">#{{$cartProduct->id}}</span>
                                    </td>
                                    <td>
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" onclick="decreaseSize({{$cartProduct->id}}, '{{$cartProduct->product_size}}', {{json_encode($cartProduct->size_array)}})" class="btn btn-control">
                                                        <i class="fa fa-chevron-left"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="product_size_{{$cartProduct->id}}" disabled="" class="form-control val" value="{{$cartProduct->product_size}}">
                                                <span class="input-group-btn">
                                                    <button type="button" onclick="increaseSize({{$cartProduct->id}}, '{{$cartProduct->product_size}}', {{json_encode($cartProduct->size_array)}})" class="btn btn-control">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="controls">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" onclick="removeQuantity({{$cartProduct->id}})" class="btn btn-control">
                                                        <i class="fa fa-chevron-left"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quant" disabled="" class="form-control val" value="{{$cartProduct->num_added}}">
                                                <span class="input-group-btn">
                                                    <button type="button" onclick="addProduct({{$cartProduct->id}})" class="btn btn-control">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="price">
                                            {{$cartProduct->num_added}} x {{$cartProduct->price}} = {{$sum}}€
                                        </span> 
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="removeProduct" onclick="removeProduct({{$cartProduct->id}})">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-7">
                                <h2 class="op5">{{__('public_pages.deliveries')}}</h2>
                                <div class="form-check pt-32">
                                    <input class="form-check-input" type="radio" name="payment_transfer_type" id="standardRadio" value="standard" checked>
                                    <label class="form-check-label" for="standardRadio">
                                        <h4 class="radio-label">{{__('public_pages.standard')}}</h4>
                                    </label>
                                </div>
                                <span class="comment pl-16">{{__('public_pages.standard_flat_rate')}}</span>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_transfer_type" id="expressRadio" value="express">
                                    <label class="form-check-label" for="expressRadio">
                                        <h4 class="radio-label">{{__('public_pages.express')}}</h4>
                                    </label>
                                </div>
                                <span class="comment pl-16">{{__('public_pages.expedited_ship')}}</span>
                            </div>
                            <div class="col-sm-5 pull-right">
                                <div class="d-flex">
                                    <h2>{{__('public_pages.total')}}</h2>
                                    <h4 class="ttc">{{__('public_pages.ttc')}}</h4>
                                    <h2>:</h2>
                                    <h2 class="pl-16 op5">{{$sum_total}}€</h2>
                                </div>
                                <div class="d-flex pt-32">
                                    <span class="small-text op8 fs-italic">{{__('public_pages.payment_comment')}}</span>
                                </div>
                                <div class="d-flex pt-40">
                                    @if( isset(Auth::user()->type) && Auth::user()->type=='customer' )
                                    <a href="{{ lang_url('customer/charge') }}" onclick="saveTransferType();" class="m0 btn btn-primary pull-right px-32">
                                        {{__('public_pages.payment')}}
                                    </a>
                                    @else
                                    <a href="{{ lang_url('customer/login') }}" class="m0 btn btn-primary pull-right px-32">
                                        {{__('public_pages.payment')}}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php
                        } else {
                        @endphp 
                        <a href="{{lang_url('products')}}" class="btn btn-primary btn-lg btn-squared">{{__('public_pages.first_need_add_products')}}</a>
                        @php 
                        }
                        @endphp
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
  
</div>

<script>

    function increaseSize(product_id, current_size, size_array) {
        var res = 'XS';
        console.log('increase ===', current_size, size_array);
        if (size_array && size_array.length > 0) {
            var size_len = size_array.length;
            var idx = size_array.indexOf(current_size);
            if (idx > -1) {
                res = (idx == size_len - 1) ?  size_array[size_len - 1] : size_array[idx + 1];
            } else {
                res = size_array[0];
            }
        }
        console.log('res == ', res)
        changeSize(product_id, res);
    }

    function decreaseSize(product_id, current_size, size_array) {
        var res = 'XS';
        console.log('decrease ===', current_size, size_array);
        if (size_array && size_array.length > 0) {
            var size_len = size_array.length;
            var idx = size_array.indexOf(current_size);
            if (idx > -1) {
                res = (idx == 0) ?  size_array[0] : size_array[idx - 1];
            } else {
                res = size_array[0];
            }
        }
        console.log('res == ', res)
        changeSize(product_id, res);
    }
</script>
@endsection
