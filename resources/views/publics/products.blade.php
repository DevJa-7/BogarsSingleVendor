@extends('layouts.app_public')

@section('content')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" /> 
<div class="products-page">
    <div class="container-middle">
        <div class="row m0">
            <div class="col-lg-2">
                <div class="categories">
                    <ul class="parent">
                        <li class="{{ !isset($selectedCategory) ? 'active' : ''}}"> 
                            <a href="{{ lang_url('products') }}">
                                {{__('public_pages.product_all')}}
                            </a>
                        </li>
                    </ul>
                    @php 
                    function loop_tree($treeArr, $is_recursion = false, $selectedCategory)
                    { 
                    @endphp
                    <ul class="{{$is_recursion === true ? 'children' : 'parent' }}">
                        @php
                        foreach ($treeArr as $tree) {
                        $children = false;
                        if (isset($tree->children) && !empty($tree->children)) {
                        $children = true;
                        }
                        @endphp
                        <li class="{{ isset($selectedCategory) && $selectedCategory == $tree->url ? 'active' : ''}}"> 
                            <a href="{{ lang_url('category/'.$tree->url) }}">
                                {{$tree->name}}
                            </a>
                            @php
                            if ($children === true) {
                            loop_tree($tree->children, true, $selectedCategory);
                            } else {
                            @endphp
                        </li>
                        @php
                        }
                        }
                        @endphp
                    </ul>
                    @php
                    if ($is_recursion === true) {
                    @endphp
                    </li>
                    @php
                    }
                    }
                    @endphp
                    @php
                    loop_tree($categories, false, $selectedCategory);
                    @endphp
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <!-- <div class="col-xs-12 section-title">
                        <h2>{{__('public_pages.all_products')}}</h2>
                        <div class="dropdown dropdown-order">
                            <button class="btn btn-bordered dropdown-toggle" type="button" data-toggle="dropdown">
                                @php
                                if(isset($_GET['order_by']) == 'created_at' && isset($_GET['type']) == 'asc'){
                                @endphp
                                {{__('public_pages.order_date_asc')}}
                                @php
                                }
                                elseif(isset($_GET['order_by']) == 'created_at' && isset($_GET['type']) == 'desc'){                    
                                @endphp
                                {{__('public_pages.order_date_desc')}}
                                @php
                                } else {
                                @endphp
                                {{__('public_pages.title_order')}}
                                @php 
                                }
                                @endphp 
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?order_by=created_at&type=asc">{{__('public_pages.order_date_asc')}}</a></li>
                                <li><a href="?order_by=created_at&type=desc">{{__('public_pages.order_date_desc')}}</a></li>
                            </ul>
                        </div>
                    </div> -->

                    @php
                    if(!$products->isEmpty()) {
                    @endphp
                    @foreach ($products as $product)
                    <div class="col-6 col-sm-6 col-md-4 product-container">
                        <div class="product">
                            <div class="img-container">
                                <a href="{{ lang_url($product->url) }}">
                                    <img src="{{asset('storage/'.$product->image)}}" class="product-image" alt="{{$product->name}}">
                                </a>
                                <span class="add-cart">
                                    <!-- <i class="fa fa-plus pr-2"></i>
                                    <i class="fa fa-cart-arrow-down pr-2"></i> -->
                                    <img src="{{asset('storage/plus_icon.png')}}" data-product-id="{{$product->id}}" class="cursor-pointer pr-4 buy-now to-cart" alt="plus_icon">
                                    <a href="{{lang_url('checkout')}}">
                                        <img src="{{asset('storage/cart_icon.png')}}" class="pr-2" alt="cart_icon">
                                    </a>
                                </span>
                            </div>
                            <div class="desc-container">
                                <a href="{{ lang_url($product->url) }}">
                                    <h1>{{$product->name}}</h1>
                                </a>
                                <span class="made_country small-text grey-color">{{$product->made_country ? __('public_pages.made_in').$product->made_country : '&nbsp;'}}</span>
                                <span class="price">€{{$product->price}}</span>
                            </div>                                
                        </div>
                    </div> 
                    @endforeach
                    @php
                    } else {
                    @endphp 
                    <div class="col-xs-12">
                        <div class="alert alert-danger">{{__('public_pages.no_products')}}</div>
                    </div>
                    @php
                    }
                    @endphp
                </div>
                {{ $products->links() }}
            </div>
        </div> 
    </div>
</div>
<script src="{{ asset('js/bootstrap-select.min.js') }}" type="text/javascript"></script>

@endsection