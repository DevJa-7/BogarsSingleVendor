@extends('layouts.app_public')

@section('content')
<div class="customer-body">

    <div class="container-large px-16 body-height">
        <div class="row px-16">
            <div class="col-sm-12">
                <h2>{{__('customer_pages.my_orders')}}</h2>
            </div>
        </div>
        <div class="row pt-50">
            <div class="col-sm-2">
                <div class="list pt-0">
                    <ul class="parent">
                        <li class="active"> 
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
                                    {{ $order->status == 0 ?  __('public_pages.ord_sale') : '' }}
                                    {{ $order->status == 1 ?  __('public_pages.ord_transit') : '' }}
                                    {{ $order->status == 2 ?  __('public_pages.ord_received') : '' }}
                                    {{ $order->status == 3 ?  __('public_pages.ord_refused') : '' }}
                                    {{ $order->status == 4 ?  __('public_pages.rtn_returning') : '' }}
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
                                        <a class="small-text grey-color" onclick="returnProduct({{ $order->order_id }});">{{__('public_pages.return')}}</a>
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
                                                                <label>{{__('public_pages.size')}}</label>
                                                                <input type="text" name="size" value="{{ (isset($product['product_size']) && !empty($product['product_size'])) ? $product['product_size'] : '' }}" disabled>
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
                                                                <input type="text" name="price" value="{{ $sum }}" disabled>
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
                                                                <input type="text" name="cost" value="{{ $producta->price }}" disabled>
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
        console.log('tr_id', tr_id)
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
</script>
@endsection

