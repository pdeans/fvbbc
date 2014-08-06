@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/create.css') }}
@stop

@section('content')

    <h2>Create your <span class="fvbbc">&#35;FVBBC</span> Account</h2>

    <form action="{{ URL::route('user-create-post') }}" method="post">

        <label class="note" for="note">
            Note: Fields marked <span class="required">&#42;&nbsp;</span> are required
        </label>

        <div class="field name">
            <label for="firstname">Name <span class="required">&#42;</span></label><br>

            <input type="text" name="firstname" placeholder="First"{{ (Input::old('firstname')) ? ' value="' . e(Input::old('firstname')) . '"' : '' }} autofocus>

            <input class="input-last" type="text" name="lastname" placeholder="Last"{{ (Input::old('lastname')) ? ' value="' . e(Input::old('lastname')) . '"' : '' }}>

            @if ($errors->has('firstname'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('firstname') }}
                </p>
            @endif

            @if ($errors->has('lastname'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('lastname') }}
                </p>
            @endif

        </div>

        <div class="field">
            <label for="username">Choose your username <span class="required">&#42;</span></label><br>

            <input type="text" name="username"{{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>

            @if ($errors->has('username'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('username') }}
                </p>
            @endif
        </div>

        <div class="field">
            <label for="password">Create a password <span class="required">&#42;</span></label><br>

            <input type="password" name="password">

            @if ($errors->has('password'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>

        <div class="field">
            <label for="confirmPassword">Confirm Password <span class="required">&#42;</span></label><br>

            <input type="password" name="password_confirm">

            @if ($errors->has('password_confirm'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    Passwords must match.
                </p>
            @endif
        </div>

        <div class="field email">
            <label for="email">Your current email address <span class="required">&#42;</span></label><br>

            <input type="email" name="email" placeholder="example@example.com"{{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>

            @if($errors->has('email'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>

        <label class="note" for="note">
            Note: Following fields are not required, however, highly encouraged to get the full
            <span class="fvbbc">&#35;FVBBC</span> experience.
        </label>

        <div class="field size">
            <label for="size">Current size</label><br>

            <input type="text" name="height" placeholder="Height (in)"{{ (Input::old('height')) ? ' value="' . e(Input::old('height')) . '"' : '' }}>

            <input class="input-last" type="text" name="weight" placeholder="Weight (lbs)"{{ (Input::old('weight')) ? ' value="' . e(Input::old('weight')) . '"' : '' }}>

            @if ($errors->has('height'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('height') }}
                </p>
            @endif

            @if ($errors->has('weight'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('weight') }}
                </p>
            @endif
        </div>

        <div class="field totals">

            <label for="bigThree">Big 3 Total</label><br>
            <label><small>(Squat max + Bench Press max + Deadlift max)</small></label><br>
            <input type="text" name="big_three" placeholder="(lbs)"{{ (Input::old('big_three')) ? ' value="' . e(Input::old('big_three')) . '"' : '' }}>

            @if ($errors->has('big_three'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('big_three') }}
                </p>
            @endif
        </div>


        <div class="field gender">
            <label for="gender">Gender</label><br>
            <input type="radio" name="gender" value="male" checked> Male <br>
            <input type="radio" name="gender" value="female"> Female

            @if ($errors->has('gender'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('gender') }}
                </p>
            @endif
        </div>

        <button type="submit" class="button btn btn-lg">Create Account</button>

        {{ Form::token() }}
    </form>

@stop
