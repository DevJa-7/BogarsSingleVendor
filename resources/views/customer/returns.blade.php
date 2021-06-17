@extends('layouts.app_public')

@section('content')
<div class="customer-body">

    <div class="container-large px-16 body-height">
        <div class="row px-16">
            <div class="col-sm-12">
                <h2>{{__('customer_pages.my_returns')}}</h2>
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
                        <li class="active"> 
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
                        <li class=""> 
                            <a href="{{ lang_url('customer/discount') }}">
                                {{__('customer_pages.my_discount_codes')}}
                            </a>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div class="col-sm-10">
            <div class="products-for-checkout">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fa fa-circle-o"></i></th>
                                <th scope="col">{{__('public_pages.item')}}</th>
                                <th scope="col">{{__('public_pages.time_created')}}</th>
                                <th scope="col">{{__('public_pages.item_status')}}</th>
                                <th scope="col">{{__('public_pages.item_price')}}</th>
                                <th scope="col" class="td-fit">{{__('public_pages.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order) 
                            <tr id="order_{{$order->order_id}}">
                                <td>
                                    <i class="fa fa-circle-o"></i>
                                </td>
                                <td>
                                    {{ $order->order_id }}
                                </td>
                                <td>
                                    {{ $order->time_created }}
                                </td>
                                <td class="order-status">
                                    {{ $order->status == 4 ?  __('public_pages.rtn_process') : '' }}
                                    {{ $order->status == 5 ?  __('public_pages.rtn_refunded') : '' }}
                                    {{ $order->status == 6 ?  __('public_pages.rtn_refused') : '' }}
                                </td>
                                <td>
                                    @php
                                    $sum = 0;
                                    foreach(unserialize($order->products) as $product) {
                                    $sum = $sum + (int)$product['quantity'] * (float)$product['price'];
                                    }
                                    @endphp
                                    €{{$sum}}
                                </td>
                                <td class="td-fit">
                                    <div class="show-hold">
                                        <a class="small-text grey-color pr-16 show-more" data-show-tr="{{ $order->order_id }}" id="show_order_{{$order->order_id}}">{{__('public_pages.see')}}</a>
                                        @php
                                        if ($order->status > 4){
                                        @endphp
                                        <a class="small-text grey-color leave-review" data-show-review-tr="{{ $order->order_id }}" id="review_order_{{$order->order_id}}">
                                            {{(isset($order->review) && !empty($order->review)) ? __('public_pages.show_review') : __('public_pages.leave_review')}}
                                        </a>
                                        @php
                                        } 
                                        @endphp
                                    </div>
                                </td>
                            </tr>
                            <tr class="tr-more" data-tr="{{ $order->order_id }}">
                                <td colspan="6">
                                    @php
                                    foreach(unserialize($order->products) as $product) {
                                    $producta = $controller->getProductInfo($product['id']);
                                    $sum = (int)$product['quantity'] * (float)$product['price'];
                                    @endphp
                                    <div class="row p-16 border-b-dashed">
                                        <div class="col-md-2 col-sm-3 col-xs-4">
                                            <a href="{{ lang_url($producta->url) }}" target="_blank">
                                                <img src="{{asset('storage/'.$producta->image)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="col-md-10 col-sm-9 col-xs-8">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-xs-8">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.display_name')}}</label>
                                                                <input type="text" name="display_name" value="{{ $producta->name }}" disabled>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.item')}}</label>
                                                                <input type="text" name="item" value="{{ $producta->name }}" disabled>
                                                            </div> 
                                                        </div>
                                                        <div class="col-xs-4">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.barcode')}}</label>
                                                                <input type="text" name="barcode" value="Barcode" disabled>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="d-flex pl-8 pt-8">
                                                        <span class="body-text pr-16">
                                                            {{__('public_pages.stock')}}
                                                        </span>
                                                        <span class="body-text">
                                                            20
                                                        </span>
                                                    </div>
                                                    <div class="d-flex pl-8 pt-8">
                                                        <span class="body-text pr-16">
                                                            {{__('public_pages.site')}}
                                                        </span>
                                                        <span class="body-text">
                                                            20
                                                        </span>
                                                    </div>
                                                    <div class="d-flex pl-8 pt-8">
                                                        <span class="body-text pr-16">
                                                            {{__('public_pages.reserved')}}
                                                        </span>
                                                        <span class="body-text">
                                                            20
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.price')}}</label>
                                                                <input type="text" name="price" value="{{ $producta->price }}" disabled>
                                                            </div> 
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.collection')}}</label>
                                                                <input type="text" name="collection" value="Summer 2077" disabled>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="col-xs-4">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.cost')}}</label>
                                                                <input type="text" name="cost" value="{{ $producta->name }}" disabled>
                                                            </div> 
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="cm-form">
                                                                <label>{{__('public_pages.made_in')}}</label>
                                                                <input type="text" name="made_in" value="{{ $producta->made_country}}" disabled>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="d-flex pt-8">
                                                        <span class="body-text pr-16">
                                                            {{__('public_pages.category')}}
                                                        </span>
                                                        <span class="body-text">
                                                            which category
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    }
                                    @endphp
                                </td>
                            </tr>
                            <tr class="tr-review" data-review-tr="{{ $order->order_id }}">
                                <td colspan="6">
                                    <div class="row p-16 border-b-dashed">
                                        <div class="col-md-12">
                                            @php
                                            if (isset($order->review) && !empty($order->review)) {
                                            @endphp
                                            <div class="cm-form">
                                                <h5>{{__('public_pages.review')}}</h5>
                                                <span class="body-text d-flex pt-16">{{$order->review}}</span>
                                            </div>
                                            @php
                                            } else {
                                            @endphp
                                            <div class="cm-form">
                                                <h5>{{__('public_pages.leave_review')}}</h5>
                                                <textarea class="form-control py-16" placeholder="{{__('public_pages.write_here')}}" id="review_{{ $order->order_id }}" name="review"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary pull-right px-32" onclick="sendReview({{ $order->order_id }});">
                                                    {{__('public_pages.send')}}
                                                </button>
                                            </div>
                                            @php
                                            }
                                            @endphp
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
  
</div>

<script>

    $('.show-more').click(function () {
        var tr_id = $(this).data('show-tr');
        $('table').find('[data-tr="' + tr_id + '"]').toggle(function () {
            if ($('[data-tr="' + tr_id + '"]').is(':visible')) {
                $('#show_order_'+tr_id).text('Hold');
                $('#order_'+tr_id).css('background', '#FAFAFA');
            } else {
                $('#show_order_'+tr_id).text('See');
                $('#order_'+tr_id).css('background', 'transparent');
            }
        });

    });

    $('.leave-review').click(function () {
        var tr_id = $(this).data('show-review-tr');
        
        var txt = $('#review_order_'+tr_id).text();
        $('table').find('[data-review-tr="' + tr_id + '"]').toggle(function () {
            if ($('[data-review-tr="' + tr_id + '"]').is(':visible')) {
                $('#review_order_'+tr_id).text(txt);
            } else {
                $('#review_order_'+tr_id).text(txt);
            }
        });

    });

    function sendReview(id) {
        var msg = $('#review_'+id).val();
        leaveReviewProduct(id, msg);
    }
</script>
@endsection

