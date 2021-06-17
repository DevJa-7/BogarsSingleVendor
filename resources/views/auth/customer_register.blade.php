@extends('layouts.app_public')

@section('content')
<div class="container">

    <div class="div-center-middle body-height">
        <div class="auth-body">
            <h1 class="text-center">{{__('public_pages.registeration')}}</h1>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('customer.register') }}">
                    {{ csrf_field() }}

                    <div class="pt-16 form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="cm-form">
                            <label>{{__('public_pages.fullname')}}</label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                    <div class="pt-16 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="cm-form">
                            <label>{{__('public_pages.email_phonenumber')}}</label>
                            <input type="text" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>

                    <div class="pt-16 form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                        <div class="cm-form">
                            <label>{{__('public_pages.birthdate')}}</label>
                            <input type="text" name="birthdate" value="{{ old('birthdate') }}" required>
                            @if ($errors->has('birthdate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthdate') }}</strong>
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
                        <div class="cm-form">
                            <label>{{__('public_pages.repeat_password')}}</label>
                            <input id="password-confirm" type="password" name="password_confirmation" required>
                        </div> 
                    </div>
                    
                    <div class="pt-16 form-group">
                        <div class="cm-form">
                            <label>{{__('public_pages.agree_term')}}</label>
                        </div> 
                    </div>

                    <div class="pt-16 form-group">
                        <div class="col-sm-6 p0">
                            <span class="super-small-text">
                                {{__('public_pages.already_have_account')}}
                            </span>
                        </div>
                        <div class="col-sm-6 p0">
                            <button type="submit" class="btn btn-primary pull-right px-32">
                                {{__('public_pages.signup')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</div>
@endsection
