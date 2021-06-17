@extends('layouts.app_public')

@section('content')
<div class="home-page">
    <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- for showing only 1 carousel -->
            <!-- <ol class="carousel-indicators"> 
                @php
                $i=0;
                @endphp 
                @foreach($carousel as $slide)
                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="{{ $i == 0 ? 'active' : ''}}"></li>
                @php
                $i++;
                @endphp 
                @endforeach
            </ol> -->
            <div class="carousel-inner">
                @php
                $i=0;
                @endphp 
                @foreach($carousel as $slide)
                <div class="item {{ $i == 0 ? 'active' : ''}}">
                    <a href="{{$slide->link}}">
                        <img src="{{asset('storage/'.$slide->image)}}" alt="">
                    </a>
                </div>
                @php
                $i++;
                @endphp 
                @endforeach
            </div>
            <!-- for showing only 1 carousel -->
            <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a> -->
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @foreach ($mostSelledProducts as $mostSelledProduct)
            <div class="col-6 col-sm-6 col-md-4 product-container">
                <div class="product">
                    <div class="img-container">
                        <a href="{{ lang_url($mostSelledProduct->url) }}">
                            <img src="{{asset('storage/'.$mostSelledProduct->image)}}" class="product-image" alt="{{$mostSelledProduct->name}}">
                        </a>
                        <span class="add-cart">
                            <!-- <i class="fa fa-plus pr-2"></i>
                            <i class="fa fa-cart-arrow-down pr-2"></i> -->
                            <img src="{{asset('storage/plus_icon.png')}}" data-product-id="{{$mostSelledProduct->id}}" class="cursor-pointer pr-4 buy-now to-cart" alt="plus_icon">
                            <a href="{{lang_url('checkout')}}">
                                <img src="{{asset('storage/cart_icon.png')}}" class="pr-2" alt="cart_icon">
                            </a>
                        </span>
                    </div>
                    <div class="desc-container">
                        <a href="{{ lang_url($mostSelledProduct->url) }}">
                            <h1>{{$mostSelledProduct->name}}</h1>
                        </a>
                        <span class="made_country small-text grey-color">{{$mostSelledProduct->made_country ? __('public_pages.made_in').$mostSelledProduct->made_country : '&nbsp;'}}</span>
                        <span class="price">€{{$mostSelledProduct->price}}</span>
                    </div>                                
                </div>
            </div>
            @endforeach
        </div> 
    </div>

    <div class="subscribe">
        <div class="div-center">
            <span class="title">{{__('public_pages.newsletter')}}</h2>
        </div>
        <div class="div-center">
            <span class="sub-title">-10% {{__('public_pages.on_your_next_order')}}</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="cm-form">
                        <label>{{__('public_pages.fullname')}}</label>
                        <input type="text" name="fullname" value="">
                    </div> 
                </div>
                <div class="col-sm-4">
                    <div class="cm-form">
                        <label>{{__('public_pages.email')}}</label>
                        <input type="text" name="email" value="">
                    </div> 
                </div>
                <div class="col-sm-4 sub-btn">
                    <div class="div-center">
                        <button class="btn btn-primary px-32">{{__('public_pages.subscribe')}}</button>
                    </div> 
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
$('#inner-slider').carousel({
  interval: 40000
})

$('.featured .carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<0;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().appendTo($(this));
  }
});

</script>
@endsection
