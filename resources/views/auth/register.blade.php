@extends('layouts.app')

@section('content')
<form class="form-signin" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="panel periodic-login">
        <div class="panel-body text-center">
            <h1 class="atomic-symbol">EMS</h1>
                <p class="element-name">Evans & Mokaba Solutions </p>

            <i class="icons icon-arrow-down"></i>
            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="name" type="text" class="form-text{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    <span class="bar"></span>
                <label for="name">{{ __('Name') }}</label>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

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

            <div class="form-group form-animate-text" style="margin-top:40px !important;">
                <input id="password-confirm" type="password" class="form-text" name="password_confirmation" required>
                    <span class="bar"></span>
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>

            <input type="submit" class="btn col-md-12" value="{{ __('Register') }}"/>
        </div>
        <div class="text-center" style="padding:5px;">
            <a href="login">Already have an account?</a>
        </div>
    </div>
</form>
@endsection
