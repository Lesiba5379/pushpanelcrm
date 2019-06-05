@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<form method="POST" action="{{ route('password.email') }}" class="form-signin">
    @csrf
    <div class="panel periodic-login">
        <div class="panel-body text-center">
            <img src="{{ URL::asset('asset/img/login.png') }}" style="margin-left: -15px; margin-top: -15px;">

            <!--i class="icons icon-arrow-down"></i-->
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="email" type="email" class="form-text{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    <span class="bar"></span>
                <label for="email">{{ __('E-Mail Address') }}</label>
                <p>Input your email to reset  your password</p>
                              
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <input type="submit" class="btn col-md-12" value="{{ __('Send Password Reset Link') }}"/>
        </div>
        <div class="text-center" style="padding:5px;">
            <a href="{{ route('login') }}">SignIn</a>
        </div>
    </div>
</form>
@endsection
