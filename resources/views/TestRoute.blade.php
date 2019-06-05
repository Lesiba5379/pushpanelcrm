@extends('layouts.app')

@section('content')
<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="panel periodic-login">
        <div class="panel-body text-center">
        <img src="../asset/img/logo.png" style="height: 175px; width:280px; margin-left: -15px; margin-top: -15px;">
                <!--br /><p class="element-name">Evans & Mokaba Solutions </p->

            <i class="icons icon-arrow-down"></i-->
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="email" type="email" class="form-text{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <span class="bar"></span>
                <label for="email">{{ __('E-Mail Address') }}</label>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="password" type="password" class="form-text{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <span class="bar"></span>
                <label for="password">{{ __('Password') }}</label>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <label class="pull-left" for="remember">
            <input class="icheck pull-left" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}
            </label>
            <input type="submit" class="btn col-md-12" value="{{ __('Login') }}"/>
        </div>
        <div class="text-center" style="padding:5px;">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
            <a href="register">| Signup</a>
        </div>
    </div>  
</form>
@endsection