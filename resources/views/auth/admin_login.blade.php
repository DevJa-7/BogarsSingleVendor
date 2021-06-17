@extends('layouts.app_admin_login')

@section('content')

<!-- End Navbar -->
<div class="wrapper wrapper-full-page ">
    <div class="full-page login-page ">
        
        <div class="content">
            <div class="container">
                <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('admin.login') }}">
                        {{ csrf_field() }}
                        <div class="card card-login card-white">
                            <div class="card-header">
                                <img src="{{asset('storage/card-primary.png')}}" alt="">
                                <h1 class="card-title">{{__('admin_pages.login')}}</h1>
                            </div>
                            <div class="card-body">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="{{__('admin_pages.email')}}" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                        </div>
                                    </div>
                                    <input type="password" placeholder="{{__('admin_pages.password')}}" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-lg btn-block mb-3">{{__('admin_pages.get_started')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="{{ asset('js/mdb.min.js') }}" type="text/javascript"></script>
@endsection