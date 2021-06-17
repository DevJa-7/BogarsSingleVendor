@extends('layouts.app_admin')

@section('content')
<!-- <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet" /> 
<link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" /> -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{__('admin_pages.publish_your_products')}}
                </h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="folder" value="{{isset($product['product']->folder) ? $product['product']->folder : '0'}}">

                    <div class="md-form available-translations">
                        <span>{{__('admin_pages.choose_locale')}}</span>
                        @foreach ($locales as $locale)
                        <button type="button" data-locale-change="{{$locale}}" class="btn btn-primary btn-simple locale-change @if ($currentLocale == $locale) active @endif">{{$locale}}</button>
                        @endforeach
                    </div>
                    <hr>
                    @foreach ($locales as $locale)
                    @php $lKey = false; if($product['translations'] != null) { $lKey = array_search($locale, array_column($product['translations'], 'locale')); } @endphp
                    <input type="hidden" name="translation_order[]" value="{{$locale}}">
                    <div class="locale-container locale-container-{{$locale}}" @if ($currentLocale==$locale) style="display:block;" @endif>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-name-{{$locale}}">{{__('admin_pages.product_name')}}({{$locale}})</label>
                                    <input type="text" name="name[]" class="form-control" value="{{ $lKey !== false ? $product['translations'][$lKey]->name : '' }}" id="publishForm-name-{{$locale}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="productDescr-{{$locale}}">{{__('admin_pages.product_description')}}({{$locale}})</label>
                                    <textarea name="description[]" type="text" id="productDescr-{{$locale}}" class="form-control" rows="4" cols="80">{{ $lKey != false ? $product['translations'][$lKey]->description : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-country-{{$locale}}">{{__('admin_pages.made_country')}}({{$locale}})</label>
                                    <input type="text" name="made_country[]" class="form-control" value="{{ $lKey !== false ? $product['translations'][$lKey]->made_country : '' }}" id="publishForm-country-{{$locale}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-color-{{$locale}}">{{__('admin_pages.color')}}({{$locale}})</label>
                                    <input type="text" name="color[]" class="form-control" value="{{ $lKey !== false ? $product['translations'][$lKey]->color : '' }}" id="publishForm-color-{{$locale}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-material-{{$locale}}">{{__('admin_pages.material')}}({{$locale}})</label>
                                    <input type="text" name="material[]" class="form-control" value="{{ $lKey !== false ? $product['translations'][$lKey]->color : '' }}" id="publishForm-material-{{$locale}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-model_size-{{$locale}}">{{__('admin_pages.model_size')}}({{$locale}})</label>
                                    <input type="text" name="model_size[]" class="form-control" value="{{ $lKey !== false ? $product['translations'][$lKey]->model_size : '' }}" id="publishForm-model_size-{{$locale}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-model_tall-{{$locale}}">{{__('admin_pages.model_tall')}}({{$locale}})</label>
                                    <input type="text" name="model_tall[]" class="form-control" value="{{ $lKey !== false ? $product['translations'][$lKey]->model_tall : '' }}" id="publishForm-model_tall-{{$locale}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="publishForm-price-{{$locale}}">{{__('admin_pages.product_price')}}({{$locale}})</label>
                                    <input type="text" name="price[]" value="{{ $lKey !== false ? $product['translations'][$lKey]->price : '' }}" id="publishForm-price-{{$locale}}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="publishForm-quantity">{{__('admin_pages.quantity')}}</label>
                                <input type="text" name="quantity" value="{{isset($product['product']->quantity) ? $product['product']->quantity : ''}}" id="publishForm-quantity" class="form-control">
                            </div>
                        </div>
                    </div>

                    
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="publishForm-position">{{__('admin_pages.order_position')}}</label>
                                <input type="text" name="order_position" value="{{isset($product['product']->order_position) ? $product['product']->order_position : ''}}" id="publishForm-position" class="form-control">
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="publishForm-linkto">{{__('admin_pages.link_to')}}</label>
                                <input type="text" name="link_to" value="{{isset($product['product']->link_to) ? $product['product']->link_to : ''}}" id="publishForm-linkto" class="form-control">
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('admin_pages.choose_category')}}</label>
                                <select class="form-control" name="category_id">
                                    @foreach ($allCategories as $aCateg)
                                    <option value="{{$aCateg->id}}" {{isset($product['product']->category_id) && $product['product']->category_id == $aCateg->id ? 'selected' : ''}}>{{$aCateg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{__('admin_pages.supported_size')}}</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_xs) && $product['product']->size_xs == 1 ? 'checked="checked"' : ''}} name="size_xs">
                                    <span class="form-check-sign"></span>
                                    XS
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_s) && $product['product']->size_s == 1 ? 'checked="checked"' : ''}} name="size_s">
                                    <span class="form-check-sign"></span>
                                    S
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_m) && $product['product']->size_m == 1 ? 'checked="checked"' : ''}} name="size_m">
                                    <span class="form-check-sign"></span>
                                    M
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_l) && $product['product']->size_l == 1 ? 'checked="checked"' : ''}} name="size_l">
                                    <span class="form-check-sign"></span>
                                    L
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_xl) && $product['product']->size_xl == 1 ? 'checked="checked"' : ''}} name="size_xl">
                                    <span class="form-check-sign"></span>
                                    XL
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_xxl) && $product['product']->size_xxl == 1 ? 'checked="checked"' : ''}} name="size_xxl">
                                    <span class="form-check-sign"></span>
                                    XXL
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" {{isset($product['product']->size_xxxl) && $product['product']->size_xxxl == 1 ? 'checked="checked"' : ''}} name="size_xxxl">
                                    <span class="form-check-sign"></span>
                                    XXXL
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <label>{{__('admin_pages.hidden_product')}}: </label>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <input type="checkbox" class="bootstrap-switch" {{isset($product['product']->hidden) && $product['product']->hidden == 1 ? 'checked="checked"' : ''}} data-on-color="secondary" name="hidden">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <label>{{__('admin_pages.featured_product')}}: </label>
                        </div>
                        <div class="col-10">
                            <div class="form-group">
                                <input type="checkbox" class="bootstrap-switch" {{isset($product['product']->featured) && $product['product']->featured == 1 ? 'checked="checked"' : ''}} data-on-color="secondary" name="featured">
                            </div>
                        </div>
                    </div>

                    <!--  <div class="md-form">
                        <label>{{__('admin_pages.tags_product')}}</label>
                        <div class="element-label-text bordered-div">
                            <input type="text" data-role="tagsinput" value="{{isset($product['product']->tags) ? $product['product']->tags : ''}}" name="tags"  class="form-control input-tags"> 
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-2">
                            <label>{{__('admin_pages.cover_image')}}</label>
                        </div>
                        <div class="col-10">
                            <div class="fileinput text-center {{isset($product['product']->image) ? 'fileinput-exists' : 'fileinput-new'}}" data-provides="fileinput">

                                <div class="fileinput-preview fileinput-exists thumbnail">
                                    @php
                                    if(isset($product['product']->image)) {
                                    @endphp
                                    <input type="hidden" value="{{$product['product']->image}}" name="old_image">
                                    <img src="{{asset('storage/'.$product['product']->image)}}">
                                    @php
                                    }
                                    @endphp
                                </div>
                                <div>
                                    <span class="btn btn-rose btn-round btn-file">
                                        <span class="fileinput-new">{{__('admin_pages.choose_new_cover_img')}}</span>
                                        <span class="fileinput-exists">{{__('admin_pages.choose_cover_img')}}</span>
                                        <input type="file" name="cover_image" />
                                    </span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <label>{{__('admin_pages.gallery_images')}}</label>
                        </div>
                        <div class="col-10">
                            <div class="gallery-images">
                                @php
                                $i = 0;
                                if(isset($product['product']->folder)) {
                                @endphp

                                @php
                                $dir = '../storage/app/public/moreImagesFolders/'.$product['product']->folder.'/';
                                if (is_dir($dir)) {
                                if ($dh = opendir($dir)) {

                                while (($file = readdir($dh)) !== false) {
                                if (is_file($dir . $file)) {
                                @endphp
                                <div id="image-container-{{$i}}">
                                    <img src="{{asset('storage/moreImagesFolders/'.$product['product']->folder.'/'.$file)}}" alt="{{__('admin_pages.no_choosed_image')}}">
                                    <a href="javascript:void(0);" onclick="removeGalleryImage('{{$product['product']->folder.'/'.$file}}', {{$i}})"><i class="tim-icons icon-trash-simple"></i></a>
                                </div>
                                @php
                                $i++;
                                }
                                }
                                closedir($dh);
                                }
                                }
                                @endphp

                                @php
                                }
                                @endphp
                            </div>
                            <div class="gallery_btn">
                                <span class="btn btn-rose btn-round btn-file" id="gallery_add_{{$i}}">
                                    <span>{{__('admin_pages.add_gallery_image')}}</span>
                                    <input type="file" name="gallery_image[]" class="gallery-image" multiple>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="text-right">
                        <button class="btn btn-secondary waves-effect waves-light">{{__('admin_pages.save')}}</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
</div>

<script src="{{ asset('js/plugins/bootstrap-switch.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('.bootstrap-switch').bootstrapSwitch();

        // $('.input-tags').tagsinput({
        //     tagClass: function() { 
        //         return 'label label-secondary';
        //     }
        // }); 
    });

    var _i = Number('{{$i}}');
    $(function() {
        $(document).on("change", ".gallery-image", function(e) {

            if (this.files && this.files[0]) {
                for (var i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[i]);
                }
            }
        });
    });

    function imageIsLoaded(e) {
        $('.gallery-images').append('\
            <div id="image-container-' + _i + '">\
                <img src=' + e.target.result + '>\
                <a href="javascript:void(0);" onclick="removePrevImage(' + _i + ')"><i class="tim-icons icon-trash-simple"></i></a>\
            </div>\
        ');
        $('#gallery_add_' + _i).hide();
        var btn_label = "{{__('admin_pages.add_gallery_image')}}";

        _i++;

        $('.gallery_btn').append(' \
            <span class="btn btn-rose btn-round btn-file" id="gallery_add_' + _i + '"> \
                <span>' + btn_label + '</span> \
                <input type="file" name="gallery_image[]" class="gallery-image" multiple > \
            </span> \
        ');
    };

    function removePrevImage(index) {
        if ($('#image-container-' + index)) {
            $('#image-container-' + index).remove();
        }
        if ($('#gallery_add_' + index)) {
            $('#gallery_add_' + index).remove();
        }
    }

</script>
@endsection