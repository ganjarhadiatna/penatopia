@extends('layout.index')
@section('title', 'Login')
@section('path', 'login')
@section('content')
<div class="frame-home">
    <div class="frame-sign">
        <div class="top">
            <a href="{{ url('/') }}">
                <img src="{{ asset('/img/1.png') }}" alt="">
            </a>
        </div>
        <div class="mid">
            <div class="block">
                <h2>Login Here</h2>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="block">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="txt txt-primary-color" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="block">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="txt txt-primary-color" placeholder="Password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="block">
                    <div class="checkbox">
                        <label class="btn btn-primary-color">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <div class="block">
                    <input type="submit" name="login" class="btn btn-main-color" value="Login">
                    <a href="{{ url('/register') }}">
                        <input type="button" name="signup" class="btn btn-grey-color" value="Register">
                    </a>
                </div>
            </form>
            <div class="padding-bottom">
                <span class="fa fa-lg fa-circle"></span>
                <span class="fa fa-lg fa-circle"></span>
                <span class="fa fa-lg fa-circle"></span>
            </div>
            <div class="pad-5px"></div>
            <div class="block">
                <button class="btn btn-color-fb">
                    <span class="fa fa-lg fa-facebook"></span>
                    <span>Facebook</span>
                </button>
                <button class="btn btn-color-tw">
                    <span class="fa fa-lg fa-twitter"></span>
                    <span>Twitter</span>
                </button>
                <button class="btn btn-color-gg">
                    <span class="fa fa-lg fa-google"></span>
                    <span>Google</span>
                </button>
            </div>
            <div class="block">
                <a href="{{ route('password.request') }}">
                    <button class="btn btn-primary-color">
                        Forgot Your Password?
                    </button>
                </a>
            </div>
        </div>
        <div class="bot"></div>
    </div>
</div>
@endsection
