<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <meta name="description" content="{{ $head_description }}"/>
        <meta property="og:title" content="{{ $head_title }}" />
        <meta property="og:description" content="{{ $head_description }}" />
        <meta property="og:url" content="{{urldecode(url()->current())}}" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{isset($product->image) ? asset('storage/'.$product->image) : asset('storage/logo.png')}}" />
        <title>{{ $head_title }}</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
        <link href="{{ asset('css/public.css') }}" rel="stylesheet"/>
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-custom">
                <div class="container-large">
                    <button type="button" class="navbar-toggle collapsed show-right-menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <a class="navbar-brand visible-xs" href="#">{{__('public_pages.menu')}}</a>
                    <div class="navbar-collapse collapse">
                        <div class="row">
                            <div class="col-sm-2">
                                <a href="{{ lang_url('/') }}" class="logo-container">
                                    <img src="{{asset('storage/logo.png')}}" class="img-responsive logo logo-height" alt="{{ $head_title }}">
                                </a>
                            </div>
                            <div class="col-sm-6 text-center">
                                <ul class="nav navbar-nav w-100">
                                    <li><a class="px-8" href="{{ lang_url('/') }}">{{__('public_pages.home')}}</a></li>
                                    <li><a class="px-8" href="{{ lang_url('products') }}">{{__('public_pages.collection')}}</a></li>
                                    <li><a class="pr-0" href="{{ lang_url('category/mens') }}">{{__('public_pages.mens')}}</a></li>
                                    <li><a class="px0 unset-hover" href="javascript:void(0);">/</a></li>
                                    <li><a class="pl-0" href="{{ lang_url('category/womens') }}">{{__('public_pages.womens')}}</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-3 text-right">
                                @if( isset(Auth::user()->type) && Auth::user()->type=='customer' )
                                <ul class="nav navbar-nav w-100">
                                    <li><a class="pr-0 black-color" href="{{ lang_url('customer/logout') }}">{{__('public_pages.logout')}}</a></li>
                                    <li><a class="px0 unset-hover black-color" href="javascript:void(0);">/</a></li>
                                    <li><a class="pl-0 black-color" href="{{ lang_url('customer') }}">{{__('public_pages.myaccount')}}</a></li>
                                </ul>
                                @else
                                <ul class="nav navbar-nav w-100">
                                    <li><a class="pr-0 black-color" href="{{ lang_url('customer/login') }}">{{__('public_pages.login')}}</a></li>
                                    <li><a class="px0 unset-hover black-color" href="javascript:void(0);">/</a></li>
                                    <li><a class="pl-0 black-color" href="{{ lang_url('customer/register') }}">{{__('public_pages.signup')}}</a></li>
                                </ul>
                                @endif
                            </div>
                            <div class="col-sm-1 text-right">
                                <div class="user">
                                    <a href="javascript:void(0);" class="cart-button">
                                        @php
                                        $sum = 0;
                                        $cnt = 0;
                                        if(!empty($cartProducts)) {
                                            $sum = 0;
                                                foreach($cartProducts as $cartProduct) {
                                                    $sum += $cartProduct->num_added * (int)$cartProduct->price;
                                                    $cnt += $cartProduct->num_added;
                                                }
                                        }
                                        @endphp
                                        <a href="{{lang_url('checkout')}}">
                                            <!-- <i class="fa fa-shopping-cart cart-badge" aria-hidden="true"></i>  -->
                                            <img src="{{asset('storage/cart_icon.png')}}" class="pr-4 pb-4" alt="cart_icon">
                                            <span class="small-text cart-amount">({{$cnt}}) {{$sum}}€</span>
                                        </a>
                                    </a>
                                </div>
                                <!-- <div class="cart-fast-view-container">
                                    @php
                                    $sum = 0;
                                    if(!empty($cartProducts)) {
                                    $sum = 0;
                                    @endphp
                                    <div class="cart-products-fast-view">
                                        <div class="content">
                                            <a href="javascript:void(0);" class="close-me" onclick="closeFastCartView()">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                            <ul>
                                                @foreach($cartProducts as $cartProduct)
                                                @php
                                                $sum += $cartProduct->num_added * (int)$cartProduct->price;
                                                @endphp
                                                <li>
                                                    <a href="{{lang_url($cartProduct->url)}}" class="link">                                        
                                                        <img src="{{asset('storage/'.$cartProduct->image)}}" alt="">
                                                        <span class="name">{{$cartProduct->name}}</span>
                                                        <span class="price">
                                                            {{$cartProduct->num_added}} x {{$cartProduct->price}}
                                                        </span>
                                                    </a>
                                                    <a href="javascript:void(0);" class="removeQantity" onclick="removeQuantity({{$cartProduct->id}})">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <div class="pay-sum">
                                                <span class="text">{{__('public_pages.subtotal')}}</span>
                                                <span class="sum">{{$sum}}</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <a href="{{lang_url('checkout')}}" class="green-btn">{{__('public_pages.payment')}}</a>
                                        </div>
                                    </div>
                                    @php
                                    }
                                    @endphp
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        @yield('content')
        
        <footer>
            <div class="container-large">
                <div class="row m0">
                    <div class="col-xs-12 col-sm-6 p0">
                        <div class="d-flex copy-rights">
                            <a href="{{ lang_url('/') }}" class="logo-container">
                                <img src="{{asset('storage/logo-icon.png')}}" class="img-responsive logo-icon mr-8" alt="{{ $head_title }}">
                            </a>
                            <span>&copy; Copyright 2017-2020, BOGARS, SAS</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 text-center p0">
                        <div class="row right m0">
                            <div class="col-sm-2 p0">
                                <a href="{{ lang_url('contacts') }}">{{__('public_pages.contact_us')}}</a>
                            </div>
                            <div class="col-sm-4 p0">
                                <a href="javascript:void(0);">{{__('public_pages.terms_conditions')}}</a>
                            </div>
                            <div class="col-sm-2 p0">
                                <a href="javascript:void(0);">{{__('public_pages.return_policies')}}</a>
                            </div>
                            <div class="col-sm-4 p0 social">
                                <a href="javascript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="javascript:void(0);"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                <a href="javascript:void(0);"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="javascript:void(0);"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        @if (session('msg'))
        <div class="alert {{ session('result') === true ? 'alert-success' : 'alert-danger' }} alert-top" id="notification_message">  
            @if (is_array(session('msg')))
            {!! implode('<br>',session('msg')) !!}
            @else
            {{session('msg')}}
            @endif
        </div>
        @endif
        <script>
            var urls = {
                mainUrl: "{{ lang_url('/') }}",
                addProduct: "{{ url('addProduct') }}",
                removeProductQuantity: "{{ url('removeProductQuantity') }}",
                getProducts: "{{ url('getGartProducts') }}",
                getProductsForCheckoutPage: "{{ url('getProductsForCheckoutPage') }}",
                removeProduct: "{{url('removeProduct')}}",
                returnOrder: "{{url('returnOrder')}}",
                leaveReview: "{{url('leaveReview')}}",
                changeSize:  "{{url('changeSize')}}"
            };
            var variables = {
                addressReq: "{{__('public_pages.address_field_req')}}",
                phoneReq: "{{__('public_pages.phone_field_req')}}",
                productsReq: "{{__('public_pages.productsReq')}}"
            };
            var messages = {
                returnMsg: "{{__('public_pages.return_success_msg')}}",
                leaveReviewMsg: "{{__('public_pages.leave_review_success_msg')}}",
                addProductMsg: "{{__('public_pages.add_product_msg')}}",
                changeProductSizeMsg: "{{__('public_pages.changeProductSizeMsg')}}",
            }
            var keys = {
                stripePublicKey: "{{ env('STRIPE_SANDBOX_PUBLICE_KEY') }}"
            }
            $('#notification_message').delay(5000).queue(function () {
                $(this).remove();
            });
        </script>
        <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
        <script src="{{ asset('js/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/placeholders.min.js') }}"></script>
        <script src="{{ asset('js/public.js') }}"></script>

    </body>
</html>
