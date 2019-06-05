@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('password.update') }}" class="form-signin">
    @csrf
    <div class="panel periodic-login">
        <div class="panel-body text-center">
            <h1 class="atomic-symbol">EMS</h1>
            <p class="element-name">Evans & Mokaba Solutions </p>

            <i class="icons icon-arrow-down"></i>
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                    <span class="bar"></span>
                <label for="email">{{ __('E-Mail Address') }}</label>
                <p>Input your email to reset  your password</p>

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

            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="password-confirm" type="password" class="form-text" name="password_confirmation" required>
                    <span class="bar"></span>
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>

            <input type="submit" class="btn col-md-12" value="Reset"/>
        </div>
        <div class="text-center" style="padding:5px;">
            <a href="login">SignIn</a> 
        </div>

            
    </div>
</form>
@endsection
