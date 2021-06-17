@extends('layouts.app_admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="add-slider">
            <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modalAddSlide">
                {{__('admin_pages.add_new_slide')}}
            </button>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row carousel-sliders">
    <div class="col-12"> 
        @foreach ($sliders as $slider)
        <div class="slide">
            <img src="{{asset('storage/'.$slider->image)}}" class="img-fluid z-depth-1" alt="1">
            <!-- <span class="link">
                <a href="{{$slider->link}}" target="_blank">{{$slider->link}}</a>
            </span> -->
            <!-- <span class="position z-depth-2">{{$slider->position}}</span> -->
            <a href="{{lang_url('admin/delete/slider/'.$slider->id)}}" class="btn btn-sm btn-secondary delete" data-my-message="{{__('admin_pages.are_u_sure_delete_s')}}">
                <i class="fa fa-trash mt-0"></i>
            </a>
        </div>
        @endforeach
        {{ $sliders->links() }}
    </div>
</div>

<div class="modal fade" id="modalAddSlide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary white-text">
                <h4 class="modal-title" id="myModalLabel">{{__('admin_pages.add_new_slide')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="formAddSlide" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body mb-0">
                    
                    <div class="md-form available-translations">
                        <span>{{__('admin_pages.choose_locale')}}</span>
                        @foreach ($locales as $locale)
                        <button type="button" data-locale-change="{{$locale}}" class="btn btn-primary btn-simple locale-change @if ($currentLocale == $locale) active @endif">{{$locale}}</button>
                        @endforeach
                    </div>
                    <hr>
                    @foreach ($locales as $locale)
                    <input type="hidden" name="translation_order[]" value="{{$locale}}">
                    <div class="locale-container locale-container-{{$locale}}" @if ($currentLocale == $locale) style="display:block;" @endif>
                        
                        <div class="row">
                            <div class="col-2">
                                <label>{{__('admin_pages.image_slide')}}</label>
                            </div>
                            <div class="col-10">
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">

                                    <div class="fileinput-preview fileinput-exists thumbnail">
                                    </div>
                                    <div>
                                        <span class="btn btn-rose btn-round btn-file">
                                            <span class="fileinput-new">{{__('admin_pages.choose_cover_img')}}</span>
                                            <span class="fileinput-exists">{{__('admin_pages.choose_cover_img')}}</span>
                                            <input type="file" name="image_{{$locale}}[]" class="upload-btn" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
<!-- 
                         <div class="md-form">
                            <label class="alone">{{__('admin_pages.image_slide')}}</label>
                            <div class="element-label-text">
                                <div class="upload-wrap">
                                    <button type="button" class="btn btn-secondary">{{ __('admin_pages.choose_cover_img')}}</button>
                                    <input type="file" name="image_{{$locale}}[]" class="upload-btn">
                                    <div class="file-name"></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    @endforeach
                    <!-- <div class="md-form">
                        <label class="alone">{{__('admin_pages.position')}}</label>
                        <div class="element-label-text">
                            <input type="text" value="" placeholder="1" name="position"  class="form-control"> 
                        </div>
                    </div>
                    <div class="md-form">
                        <label class="alone">{{__('admin_pages.link')}}</label>
                        <div class="element-label-text">
                            <input type="text" value="" placeholder="http://yoursite.com/product-link-1" name="link"  class="form-control"> 
                        </div>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('admin_pages.close')}}</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formAddSlide').submit();">{{__('admin_pages.add')}}</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}" type="text/javascript"></script>

<script>
    $('.upload-btn').change(function () {
        $(this).next('.file-name').show().append($(this).val());
    });
</script>
@endsection
