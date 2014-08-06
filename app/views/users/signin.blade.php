@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/create.css') }}
    {{ HTML::style('static/css/signin.css') }}
@stop

@section('content')

    <h2>Sign in to your <span class="fvbbc">&#35;FVBBC</span> Account</h2>

    <form action="{{ URL::route('user-sign-in-post') }}" method="post">

        @if(Session::has('form-message'))
            <p for="form-message" class="error">
                <span class="error-note">&#42;&#42;&#42;&nbsp;</span>{{ Session::get('form-message') }}
            </p>
        @endif

        <div class="field">
            <label for="username">Username</label><br>

            <input type="text" name="username"{{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }} autofocus>

            @if ($errors->has('username'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('username') }}
                </p>
            @endif
        </div>

        <div class="field">
            <label for="password">Password</label><br>

            <input type="password" name="password">

            @if ($errors->has('password'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>

        <div class="field options">
            <input id="remember" type="checkbox" name="remember" checked="checked"> Keep me signed in
        </div>

        <button type="submit" class="btn btn-lg">Sign in</button>

        <div class="field forgot">
            <label>
                <a href="{{ URL::route('user-forgot-password') }}">Forgot your password?</a>
            </label>
        </div>

        {{ Form::token() }}
    </form>

@stop

