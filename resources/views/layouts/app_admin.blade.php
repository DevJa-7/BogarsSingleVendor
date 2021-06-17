<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{__('admin_pages.admin_panel_title').$page_title_lang}}</title>

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"/>
        <!-- Nucleo Icons -->
        <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="{{ asset('css/black-dashboard.css?v=1.1.1') }}" rel="stylesheet" />
        <!-- Admin Custom CSS Files -->
        <link href="{{ asset('css/admin-custom.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    </head>
    
    <body class="white-content">
        <div class="wrapper">

            <div class="sidebar">
                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="javascript:void(0)" class="simple-text logo-mini">
                            {{__('admin_pages.bg')}}
                        </a>
                        <a href="javascript:void(0)" class="simple-text logo-normal">
                            {{__('admin_pages.bogars')}}
                        </a>
                    </div>
                    <ul class="nav">
                        <li>
                            <a href="{{ lang_url('admin') }}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <p>{{__('admin_pages.dashboard')}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/publish') }}">
                                <i class="tim-icons icon-world"></i>
                                <p>{{__('admin_pages.publish')}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/products') }}">
                                <i class="tim-icons icon-molecule-40"></i>
                                <p>{{__('admin_pages.products')}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/categories') }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>{{__('admin_pages.categories')}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/orders') }}">
                                <i class="tim-icons icon-basket-simple"></i>
                                <p>{{__('admin_pages.orders')}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/carousel') }}">
                                <i class="tim-icons icon-map-big"></i>
                                <p>{{__('admin_pages.carousel')}}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ lang_url('admin/users') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{__('admin_pages.users')}}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <div class="navbar-minimize d-inline">
                                <button class="minimize-sidebar btn btn-link btn-just-icon" rel="tooltip" data-original-title="Sidebar toggle" data-placement="right">
                                    <i class="tim-icons icon-align-center visible-on-sidebar-regular"></i>
                                    <i class="tim-icons icon-bullet-list-67 visible-on-sidebar-mini"></i>
                                </button>
                            </div>
                            <div class="navbar-toggle d-inline">
                                <button type="button" class="navbar-toggler">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </button>
                            </div>
                            <a class="navbar-brand" href="javascript:void(0)">{{$page_title_lang}}</a>
                        </div>
                        <button class="navbar-toggler hide-btn" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <div class="ml-auto d-flex">
                                <ul class="navbar-nav">
                                    <li class="dropdown">
                                        <button class="dropdown-toggle btn btn-primary btn-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ app()->getLocale() }}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach(Config::get('app.locales') as $locale)
                                            <a class="dropdown-item" href="{{url(getSameUrlInOtherLang($locale))}}">{{$locale}}</a>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li class="nav-search-bar input-group">
                                        <form class="d-flex" action="{{lang_url('admin/products')}}" role="search">
                                            <input class="form-control" placeholder="{{ __('admin_pages.search_product') }}" value="{{ Request::get('search') }}" name="search" type="text">
                                            <button class="btn btn-link">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="dropdown nav-item m-auto">
                                        <a href="{{url('admin/logout')}}" class="nav-link">
                                            <p>{{__('admin_pages.logout')}}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <ul class="nav">
                            <li class="nav-item">
                                <a href="{{ lang_url('admin/publish') }}" class="nav-link">
                                    {{__('admin_pages.publish')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ lang_url('admin/products') }}" class="nav-link">
                                    {{__('admin_pages.products')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ lang_url('admin/categories') }}" class="nav-link">
                                    {{__('admin_pages.categories')}}
                                </a>
                            </li>
                        </ul>
                        <div class="copyright">
                            © Copyright 2017-
                            <script>
                                document.write(new Date().getFullYear())
                            </script> {{__('admin_pages.bogars')}}, {{__('admin_pages.sas')}}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="{{ asset('js/bootstrap4.min.js') }}"></script>
        <!-- <script src="{{ asset('js/popper.min.js') }}"></script> -->
        <script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>
        <script src="{{ asset('js/black-dashboard.js') }}"></script>
        <!-- <script src="{{ asset('js/bootbox.min.js') }}"></script>
        <script src="{{ asset('js/placeholders.min.js') }}"></script> -->
        <script src="{{ asset('js/adminCustom.js') }}"></script> 

        <script>
        var urls = {
            removeGalleryImage: "{{ lang_url('admin/removeGalleryImage') }}",
            editCategory: "{{ lang_url('admin/categories') }}",
            deleteCategories: "{{ lang_url('admin/delete/categories') }}",
            changeStatus: "{{ lang_url('admin/changeOrderStatus') }}",
            deleteUserId: "{{ lang_url('admin/delete/user/') }}"
        };
        var langs = {
            selectOnlyOneCateg: "{{__('admin_pages.select_only_one_category')}}",
            selectJustOneCateg: "{{__('admin_pages.select_just_one_categ')}}",
            confirmDeleteCategories: "{{__('admin_pages.confirm_delete_categories')}}",
            encorrectemailAddr: "{{__('admin_pages.incorrect_email_addr')}}"
        }
        </script>
            
        <script>
            @if (session('msg'))
            var message = '';
            @if (is_array(session('msg')))
            message = "{!! implode('<br>',session('msg')) !!}"
            @else
            message = "{{session('msg')}}"
            @endif
            
            $(document).ready(function(){
                $.notify({
                    icon: "tim-icons icon-bell-55",
                    message: message,
                }, {
                    type: "{{ session('result') === true ? 'success' : 'danger' }}",
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            });
            @endif
        </script>

    </body>
</html>