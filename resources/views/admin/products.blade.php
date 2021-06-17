@extends('layouts.app_admin')

@section('content')
<div class="row">
    @php
    if(!$products->isEmpty()) {
    @endphp
    @foreach ($products as $product)
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="card card-cascade narrower hm-zoom">
            <div class="view overlay hm-white-slight">
                <img src="{{asset('storage/'.$product->image)}}" class="img-fluid" alt="{{__('admin_pages.no_choosed_image')}}">
                <a>
                    <div class="mask"></div>
                </a>
            </div>
            <div class="card-body text-center no-padding">
                <h4 class="card-title"><strong><a href="">{{$product->name}}</a></strong></h4>
                <p class="card-text">
                    {{strip_tags($product->description)}}
                </p>
                <div class="card-footer">
                    <div class="text-center price">{{$product->price}}</div>
                    <span class="right">
                        <a href="{{ lang_url('admin/edit/pruduct/'.$product->id) }}" class="btn btn-primary btn-sm">
                            {{__('admin_pages.edit')}}
                        </a>
                        
                        <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-primary btn-sm confirm">
                            {{__('admin_pages.delete')}}
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary white-text">
                    <h4 class="title" id="exampleModalLabel">{{__('admin_pages.confirm_delete_product')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('admin_pages.are_u_sure_delete')}}
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-secondary" data-dismiss="modal">{{__('admin_pages.cancel')}}</a>
                    <a href="{{ lang_url('admin/delete/product/'.$product->id) }}" class="btn btn-primary">{{__('admin_pages.delete')}}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @php
    } else {
    @endphp
    <div class="col-xs-12">
        <div class="alert alert-success">{{__('admin_pages.no_product_results')}}</div>
    </div>
    @php
    }
    @endphp
</div>
{{ $products->links() }}

@endsection