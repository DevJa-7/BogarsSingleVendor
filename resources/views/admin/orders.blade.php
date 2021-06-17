@extends('layouts.app_admin')

@section('content')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" /> 
<div class="orders-page">
    <div class="card card-cascade narrower">
        <div class="table-responsive-xs"> 
            <table class="table">
                <thead class="blue-grey lighten-4">
                    <tr>
                        <th>#</th>
                        <th>{{__('admin_pages.customer')}}</th>
                        <th>{{__('admin_pages.time_created')}}</th>
                        <th>{{__('admin_pages.order_type')}}</th>
                        <th>{{__('admin_pages.status')}}</th>
                        <th class="text-right"><i class="fa fa-list" aria-hidden="true"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    foreach ($orders as $order) {
                    $user = $controller->getUserInfo($order->user_id);
                    @endphp
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $order->time_created }}</td>
                        <td>{{ $order->type }}</td>
                        <td>
                            <select class="change-ord-status" data-ord-id="{{$order->orderId}}" data-style="btn-secondary"> 
                                @php
                                if ($order->status <= 3) {
                                @endphp
                                <option {{ $order->status == 0 ? 'selected="selected"' : '' }} value="0">{{__('admin_pages.ord_sale')}}</option>
                                <option {{ $order->status == 1 ? 'selected="selected"' : '' }} value="1">{{__('admin_pages.ord_transit')}}</option>
                                <option {{ $order->status == 2 ? 'selected="selected"' : '' }} value="2">{{__('admin_pages.ord_send')}}</option>
                                <option {{ $order->status == 3 ? 'selected="selected"' : '' }} value="3">{{__('admin_pages.ord_refused')}}</option>
                                @php
                                } else {
                                @endphp
                                <option {{ $order->status == 4 ? 'selected="selected"' : '' }} value="4">{{__('admin_pages.rtn_returning')}}</option>
                                <option {{ $order->status == 5 ? 'selected="selected"' : '' }} value="5">{{__('admin_pages.rtn_process')}}</option>
                                <option {{ $order->status == 6 ? 'selected="selected"' : '' }} value="6">{{__('admin_pages.rtn_refunded')}}</option>
                                <option {{ $order->status == 7 ? 'selected="selected"' : '' }} value="7">{{__('admin_pages.rtn_refused')}}</option>
                                @php
                                }
                                @endphp
                            </select>
                        </td>
                        <td class="text-right">
                            <a href="javascript:void(0);" class="btn btn-sm btn-secondary show-more" data-show-tr="{{ $order->order_id }}">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                <i class="fa fa-chevron-up" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="tr-more" data-tr="{{ $order->order_id }}">
                        <td colspan="6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul>
                                        <li>
                                            <b>{{ __('admin_pages.full_name') }}</b> <span>{{ $user->name }}</span>
                                        </li>
                                        <li>
                                            <b>{{ __('admin_pages.email') }}</b> <span>{{ $user->email }}</span>
                                        </li>
                                        <li>
                                            <b>{{ __('admin_pages.billing_address') }}</b> <span>{{ $order->billing_address }}</span>
                                        </li>
                                        <li>
                                            <b>{{ __('admin_pages.delivery_address') }}</b> <span>{{ $order->delivery_address }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    @php
                                    foreach(unserialize($order->products) as $product) {
                                    $producta = $controller->getProductInfo($product['id']);
                                    $sum = (int)$product['quantity'] * (float)$producta->price;
                                    @endphp
                                    <div class="product">
                                        <a href="{{ lang_url($producta->url) }}" target="_blank">
                                            <img src="{{asset('storage/'.$producta->image)}}" alt="">
                                            <div class="info">
                                                <span class="name"><b>{{$producta->name}}</b></span>
                                                <span class="quantity">
                                                    <b>{{ __('admin_pages.quantity') }}</b> {{$product['quantity']}}
                                                </span>
                                                <span class="size">
                                                    <b>{{ __('admin_pages.size') }}</b> {{(isset($product['product_size']) && !empty($product['product_size'])) ? $product['product_size'] : ''}}
                                                </span>
                                                <span class="price">{{$product['quantity']}}x{{$producta->price}} = {{$sum}}</span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </div>
                                    @php
                                    }
                                    @endphp
                                </div>
                            </div>
                        </td>
                    </tr>
                    @php
                    }
                    @endphp
                </tbody>
            </table>
        </div> 
    </div>
    {{ $orders->links() }}
    <!-- <div class="fast-orders">
        <div class="row">
            <div class="col-sm-6">
                <h2>{{__('admin_pages.new_fast_orders')}}</h2>
                <div class="card card-cascade narrower">
                    <div class="table-responsive-xs"> 
                        <table class="table">
                            <thead class="blue-grey lighten-4">
                                <tr>
                                    <th>{{__('admin_pages.time_created')}}</th>
                                    <th>{{__('admin_pages.phone')}}</th>
                                    <th>{{__('admin_pages.names')}}</th>
                                    <th class="text-right">{{__('admin_pages.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                if(!empty($fastOrders)) {
                                @endphp
                                @foreach ($fastOrders as $fOrder) 
                                <tr>
                                    <td>{{ $fOrder->time_created }}</td>
                                    <td>{{ $fOrder->phone }}</td>
                                    <td>{{ $fOrder->names }}</td>
                                    <td class="text-right">
                                        <a href="{{ lang_url('admin/fast/ord/is/viewed/'.$fOrder->id) }}" class="btn btn-sm btn-secondary confirm" data-my-message="{{__('admin_pages.are_u_sure_mark_fOrd')}}">
                                            {{__('admin_pages.viewed_mark')}}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @php
                                } else {
                                @endphp
                                <tr>
                                    <td colspan="4">{{__('admin_pages.no_fast_orders')}}</td>
                                </tr>
                                @php
                                }
                                @endphp
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div> -->
</div>
<script src="{{ asset('js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script>
$('.change-ord-status').change(function () {
    var order_id = $(this).data('ord-id');
    var order_value = $(this).val();
    $.ajax({
        type: "POST",
        url: urls.changeStatus,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {order_id: order_id, order_value: order_value}
    }).done(function (data) {
        showAlert('success', "{{ __('admin_pages.status_changed') }}");
    });
});
$('.show-more').click(function () {
    var tr_id = $(this).data('show-tr');
    $('table').find('[data-tr="' + tr_id + '"]').toggle(function () {
        if ($('[data-tr="' + tr_id + '"]').is(':visible')) {
            $('.orders-page .fa-chevron-up').show();
            $('.orders-page .fa-chevron-down').hide();
        } else {
            $('.orders-page .fa-chevron-up').hide();
            $('.orders-page .fa-chevron-down').show();
        }
    });

});
</script>
@endsection
