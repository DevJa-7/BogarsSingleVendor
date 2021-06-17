@extends('layouts.app_public')

@section('content')

<div class="container">    
    <div class="div-center-middle body-height">
        <div class="row w-100">
            <div class="col-sm-4 col-sm-offset-2">
                <h3 class="grey-color2 pt-32">{{__('public_pages.our_store')}}</h3>
                <span class="d-flex pt-16">{{__('public_pages.contact_address')}}</span>

                <h3 class="grey-color2 pt-32">{{__('public_pages.contact')}}</h3>
                <h5 class="d-flex pt-24 grey-color2">{{__('public_pages.phoneumber')}}</h5>
                <h5 class="d-flex pt-8">{{__('public_pages.real_phone_number')}}</h5>

                <h5 class="d-flex pt-16 grey-color2">{{__('public_pages.e_mail')}}</h5>
                <h5 class="d-flex pt-8">{{__('public_pages.contact_mail')}}</h5>

            </div>
            <div class="col-sm-6">
                <h1>{{__('public_pages.write_to_us')}}</h1>
                <div class="auth-body">
                    <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="pt-32">
                            <div class="cm-form">
                                <label class="pull-left">{{__('public_pages.fullname')}}</label>
                                <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>
                        
                        <div class="pt-24">
                            <div class="cm-form">
                                <label class="pull-left">{{__('public_pages.e_mail')}}</label>
                                <input type="text" name="client_email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>
                           
                        <div class="pt-24">
                            <div class="cm-form">
                                <label class="unset-center">{{__('public_pages.your_message')}}</label>
                                <!-- <textarea class="form-control" placeholder="{{__('public_pages.write_here')}}" name="message" value="{{ old('message') }}"></textarea> -->
                                <input class="w-50" type="text" name="client_message" value="{{ old('message') }}" placeholder="{{__('public_pages.write_here')}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>

                        <div class="pt-24 form-group">
                            <button type="submit" class="btn btn-primary pull-right px-32">
                                {{__('public_pages.send')}}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
