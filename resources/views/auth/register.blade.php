@extends('layout.index')
@section('title', 'Register')
@section('path', 'register')
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
                <h2>Register Here</h2>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="block">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="txt txt-primary-color" placeholder="Full Name" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="block">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="txt txt-primary-color" placeholder="Your Email" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="block">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="txt txt-primary-color" placeholder="Create Password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="block">
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="txt txt-primary-color" placeholder="Confirm Password" name="password_confirmation" required>
                    </div>
                </div>
                <div class="block">
                    <input type="submit" name="signup" class="btn btn-main-color" value="Register">
                    <a href="{{ url('/login') }}">
                        <input type="button" name="login" class="btn btn-grey-color" value="Login">
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
        </div>
        <div class="bot"></div>
    </div>
</div>
@endsection
