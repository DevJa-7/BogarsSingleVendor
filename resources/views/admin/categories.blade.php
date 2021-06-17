@extends('layouts.app_admin')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="tools float-right">
            <button class="btn btn-info btn-icon btn-sm" type="button" data-toggle="modal" data-target="#modalAddEditCategory">
                <i class="fa fa-plus mt-0"></i>
            </button>
            <button class="btn btn-success btn-icon btn-sm" type="button" onclick="editSelectedCategory()">
                <i class="fa fa-pencil mt-0"></i>
            </button>
            <button class="btn btn-danger btn-icon btn-sm" type="button" onclick="deleteSelectedCategory()">
                <i class="fa fa-trash mt-0"></i>
            </button>
        </div>
        <h4 class="card-title">{{__('admin_pages.manage_categories')}}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="text-primary">
                    <tr>
                        @php
                        if(!isset($_GET['type']) || $_GET['type'] == 'asc'){
                        $type='desc';
                        }else {
                        $type='asc';
                        }
                        @endphp
                        <th scope="row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </th>
                        <th>
                            <a href="?order_by=name&type={{$type}}" class="text-secondary">{{__('admin_pages.category_name')}}
                                @if ($type == 'desc' && isset($_GET['order_by']) && $_GET['order_by'] == 'name')<i class="fa fa-sort-asc ml-1"></i>
                                @elseif ($type == 'asc' && isset($_GET['order_by']) && $_GET['order_by'] == 'name') <i class="fa fa-sort-desc ml-1"></i>
                                @elseif (!isset($_GET['order_by']) || $_GET['order_by'] != 'name') <i class="fa fa-sort ml-1"></i> @endif
                            </a>
                        </th>
                        <th>
                            <a href="?order_by=parent&type={{$type}}" class="text-secondary">{{__('admin_pages.category_parent')}}
                                @if ($type == 'desc' && isset($_GET['order_by']) && $_GET['order_by'] == 'parent')<i class="fa fa-sort-asc ml-1"></i>
                                @elseif ($type == 'asc' && isset($_GET['order_by']) && $_GET['order_by'] == 'parent') <i class="fa fa-sort-desc ml-1"></i>
                                @elseif (!isset($_GET['order_by']) || $_GET['order_by'] != 'parent') <i class="fa fa-sort ml-1"></i> @endif
                            </a>
                        </th>
                        <th>
                            <a href='?order_by=position&type={{$type}}' class="text-secondary">{{__('admin_pages.category_position')}}
                                @if ($type == 'desc' && isset($_GET['order_by']) && $_GET['order_by'] == 'position')<i class="fa fa-sort-asc ml-1"></i>
                                @elseif ($type == 'asc' && isset($_GET['order_by']) && $_GET['order_by'] == 'position') <i class="fa fa-sort-desc ml-1"></i>
                                @elseif (!isset($_GET['order_by']) || $_GET['order_by'] != 'position') <i class="fa fa-sort ml-1"></i> @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    if(!$categories->isEmpty()) {
                    @endphp
                    @foreach ($categories as $categ)
                    <tr>
                        <td scope="row">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="category_id[]" value="{{$categ->id}}" type="checkbox" {{isset($categ->id) && $categ->id == 1 ? 'checked="checked"' : ''}}>
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </td>
                        <td>{{$categ->name}}</td>
                        <td>{{$categ->parent}}</td>
                        <td>{{$categ->position}}</td>
                    </tr>
                    @endforeach
                    @php
                    } else {
                    @endphp
                    <tr>
                        <td colspan="4">{{__('admin_pages.no_categories_found')}}</td>
                    </tr>
                    @php
                    }
                    @endphp
                </tbody>
            </table>
        </div>
        <hr class="my-0">
        {{ $categories->links() }}
    </div>
</div>

<div class="modal fade" id="modalAddEditCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary white-text">
                <h4 class="title"><i class="fa fa-pencil"></i> {{__('admin_pages.add_edit_category')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body mb-0">
                    <div class="md-form available-translations">
                        <span>{{__('admin_pages.choose_locale')}}</span>
                        @foreach ($locales as $locale)
                        <button type="button" data-locale-change="{{$locale}}" class="btn btn-primary btn-simple locale-change @if ($currentLocale == $locale) active @endif">{{$locale}}</button>
                        @endforeach
                    </div>
                    
                    @foreach ($locales as $locale)
                    @php $lKey = false; if($category['translations'] != null) { $lKey = array_search($locale, array_column($category['translations'], 'locale')); } @endphp
                    <input type="hidden" name="translation_order[]" value="{{$locale}}">
                    <div class="locale-container locale-container-{{$locale}}" @if ($currentLocale==$locale) style="display:block;" @endif>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="category_name-{{$locale}}">
                                        <i class="fa fa-star pr-2"></i>{{__('admin_pages.category_name')}}({{$locale}})</label>
                                    <input type="text" name="name[]" class="form-control" value="{{ $lKey !== false ? $category['translations'][$lKey]->name : '' }}" id="category_name-{{$locale}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_parent"><i class="fa fa-undo pr-2"></i>{{__('admin_pages.category_parent')}}</label>
                                <select class="form-control" name="parent" id="category_parent" data-style="btn-secondary">
                                    <option value="0" selected="">{{__('admin_pages.none_selected')}}</option>
                                    @foreach ($allCategories as $aCateg)
                                    <option value="{{$aCateg->id}}">{{$aCateg->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="category_position"><i class="fa fa-sort pr-2"></i>{{__('admin_pages.category_position')}}</label>
                                <input type="text" name="position" value="{{isset($category['category']->position) ? $category['category']->position : '0'}}" id="category_position" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-1-half">
                        <button class="btn btn-primary mb-2">{{__('admin_pages.save')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteCategories" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary white-text">
                <h4 class="title" id="exampleModalLabel">{{__('admin_pages.confirm_delete_category')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{__('admin_pages.are_u_sure_delete_ctg')}}
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-secondary" data-dismiss="modal">{{__('admin_pages.cancel')}}</a>
                <a href="javascript:void(0);" id="deleteCatgIds" class="btn btn-primary">{{__('admin_pages.delete')}}</a>
            </div>
        </div>
    </div>
</div>

<script>
    @php
    if (isset($_GET['edit'])) {
        @endphp
        $(document).ready(function() {
            $('#modalAddEditCategory').modal('show');
        });
        $("#modalAddEditCategory").on("hidden.bs.modal", function() {
            window.location.href = "{{ lang_url('admin/categories') }}";
        });
        @php
    }
    @endphp
</script>

@endsection