@extends('layouts.app_public')

@section('content')
<div class="product-preview">
    <div class="container-middle">
        <div class="row m0">
            <div class="col-sm-2">
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
                            <li class="{{ isset($selectedCategory) && $selectedCategory == $tree->id ? 'active' : ''}}"> 
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
                        loop_tree($categories, false, $product->category_id);
                        @endphp
                    </div>
                </div>
            <div class="col-sm-10">
                <div class="row first-part">
                    <div class="col-sm-5">
                        <div class="product-title visible-xs">
                            <h2>{{$product->name}}</h2>
                        </div>
                        <div id="inner-slider" class="carousel slide vertical" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="{{asset('storage/'.$product->image)}}" alt="{{$product->name}}" data-num="0" class="img-responsive img-thumbnail" alt="{{$product->name}}">
                                </div>
                                @php
                                if (!empty($gallery)) {
                                $i = 1;
                                foreach ($gallery as $image) {
                                @endphp
                                <div class="item">
                                    <img src="{{$image}}" data-num="{{$i}}" class="img-responsive img-thumbnail" alt="{{$product->name}}">
                                </div>
                                @php
                                $i++;
                                }
                                }
                                @endphp
                            </div>
                            <!-- for showing only 1 carousel -->
                            <div class="controls">
                                <a class="left carousel-control" href="#inner-slider" role="button" data-slide="prev">
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                </a>
                                <a class="right carousel-control" href="#inner-slider" role="button" data-slide="next">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="row hidden-xs">
                            <div class="col-xs-4 col-sm-6 col-md-4 text-center">
                                <a data-target="#inner-slider" class="active" data-slide-to="0" href="javascript:void(0)">
                                    <img src="{{asset('storage/'.$product->image)}}" class="img-thumbnail" alt="">
                                </a>
                            </div>
                            @php
                            if (!empty($gallery)) {
                            $i = 1;
                            foreach ($gallery as $image) {
                            @endphp
                            <div class="col-xs-4 col-sm-6 col-md-4 text-center">
                                <a data-target="#inner-slider" data-slide-to="{{$i}}" href="javascript:void(0)">
                                    <img src="{{$image}}" class="img-thumbnail" alt="">
                                </a>
                            </div>
                            @php
                            $i++;
                            }
                            }
                            @endphp
                        </div> -->
                    </div>
                    <div class="col-sm-7">
                        <div class="d-flex">
                            <h2>{{$product->name}}</h2>
                        </div>
                        <div class="d-flex">
                            <!-- !!! -->
                            <span class="small-text grey-color">{{__('public_pages.made_in')}} {{$product->made_country}}</span>
                        </div>
                        <div class="d-flex pt-16">
                            <h4>€{{$product->price}}</h4>
                        </div>
                        <div class="pt-24">
                            <div class="d-flex">
                                <span class="body-text">{{$product->description}}</span>
                            </div>
                            <div class="d-flex pt-16">
                                <span class="body-text">-{{__('public_pages.color')}}: {{$product->color}}</span>
                            </div>
                            <div class="d-flex">
                                <span class="body-text">-{{__('public_pages.material')}}: {{$product->material}}</span>
                            </div>
                            <div class="d-flex">
                                <span class="body-text">-{{__('public_pages.model_wearing_size')}}: {{$product->model_size}}</span>
                            </div>
                            <div class="d-flex">
                                <span class="body-text">-{{__('public_pages.model_is_')}} {{$product->model_tall}} {{__('public_pages.tall')}}</span>
                            </div>
                        </div>

                        <div class="size pt-24">
                            <div class="d-flex">
                                <h5 class="pr-8">{{__('public_pages.size')}}:</h5>
                                @php
                                if ($product->size_xs == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_xs == 1 ? 'XS' : ''}}</h5>
                                @php
                                }
                                @endphp
                                @php
                                if ($product->size_s == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_s == 1 ? 'S' : ''}}</h5>
                                @php
                                }
                                @endphp
                                @php
                                if ($product->size_m == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_m == 1 ? 'M' : ''}}</h5>
                                @php
                                }
                                @endphp
                                @php
                                if ($product->size_l == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_l == 1 ? 'L' : ''}}</h5>
                                @php
                                }
                                @endphp
                                @php
                                if ($product->size_xl == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_xl == 1 ? 'XL' : ''}}</h5>
                                @php
                                }
                                @endphp
                                @php
                                if ($product->size_xxl == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_xxl == 1 ? 'XXL' : ''}}</h5>
                                @php
                                }
                                @endphp
                                @php
                                if ($product->size_xxxl == 1) {
                                @endphp
                                    <h5 class="product-size-select grey-color pr-16 cursor-pointer">{{$product->size_xxxl == 1 ? 'XXXL' : ''}}</h5>
                                @php
                                }
                                @endphp
                            </div>
                        </div>

                        <div class="pt-24">
                            <div class="d-flex">
                                <h5>Shipping & Returns</h5>
                            </div>
                            <div class="d-flex pt-16">
                                <h5>View Size Chart</h5>
                            </div>
                            <div class="d-flex pt-16">
                                <h5>More infos</h5>
                            </div>
                        </div>

                        <div class="pt-24">
                            <!-- <div class="quantity">
                                <span>{{__('public_pages.quantity')}}</span>
                                <input type="text" class="field" name="quantity" value="1">
                            </div> -->
                            <a href="javascript:void(0);" data-product-id="{{$product->id}}" class="btn btn-primary px-32 buy-now to-cart">
                                {{__('public_pages.add_cart')}}
                            </a>
                            <!-- @php
                            if($product->link_to != null) {
                            @endphp
                            <a href="{{ $product->link_to }}" class="buy-now">{{__('public_pages.buy')}}</a>
                            @php
                            } else {
                            @endphp
                            <a href="javascript:void(0);" data-product-id="{{$product->id}}" class="btn btn-primary px-32 buy-now to-cart">
                                {{__('public_pages.add_cart')}}
                            </a>
                            @php
                            }
                            @endphp -->
                            <div class="clearfix"></div>
                        </div>
                        
                        <input type="hidden" name="product_size_{{$product->id}}" id="product-size">
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    $( '.product-size-select' ).on( 'click', function() {
        $( this ).parent().find( '.active' ).removeClass( 'active' );
        $( this ).addClass( 'active' );
        $('#product-size').attr('value', $(this).text());
    });
</script>

@endsection