@extends('layouts.app_public')

@section('content')

<div class="container">    
    <div class="div-center-middle body-height">
        <div class="auth-body ">
            <h1 class="text-center">{{__('public_pages.myaccount')}}</h1>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('customer.login') }}">
                    {{ csrf_field() }}
                    
                    <div class="pt-16 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="cm-form">
                            <label>{{__('public_pages.email_phonenumber')}}</label>
                            <input type="text" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                        
                    <div class="pt-16 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="cm-form">
                            <label>{{__('public_pages.password')}}</label>
                            <input id="password" type="password" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                    <div class="pt-16 form-group">
                        <input type="hidden" id="type" name="type" value="customer">
                    </div>
                    <!-- <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('public_pages.remember_me')}}
                                </label>
                            </div>
                        </div>
                    </div> -->
                    <div class="pt-16 form-group">
                        <div class="row m0 cm-form d-flex">
                            <div class="col-sm-6 p0 mt-auto">
                                <a class="super-small-text" href="{{ route('password.request') }}">
                                    {{__('public_pages.forgot_pass')}}
                                </a>
                            </div>
                            <div class="col-sm-6 p0">
                                <button type="submit" class="m0 btn btn-primary pull-right px-32">
                                    {{__('public_pages.signin')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

@endsection
