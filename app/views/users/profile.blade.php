@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/create.css') }}
@stop

@section('content')

    <div class="main-wrap profile">

        <hgroup>
            <h2>
                <span class="fvbbc">&#35;FVBBC</span> User Profile<br>
            </h2>
            <h5>
                Welcome <span class="fvbbc-sub">{{{ $user->username }}}</span>
            </h5>
        </hgroup>

        <h4>Current <span class="fvbbc">&#35;FVBBC</span> Account Settings</h4>

        <table class="table table-striped user-profile">
            <tr class="profile-field">
                <td>Name</td>
                <td>{{{ $user->firstname }}} {{{ $user->lastname }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Username</td>
                <td>{{{ $user->username }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Email</td>
                <td>{{{ $user->email }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Height</td>
                <td>{{{ $user->formatHeight($user->height) }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Weight</td>
                <td>{{{ $user->weight }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Big 3 Total</td>
                <td>{{{ $user->big_three }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Wilks Rating</td>
                <td>{{{ $user->wilks_rating }}}</td>
            </tr>

            <tr class="profile-field">
                <td>Gender</td>
                <td>{{{ $user->gender }}}</td>
            </tr>
        </table>
    </div>

    <h4 class="hr">Edit your <span class="fvbbc">&#35;FVBBC</span> Account</h4>

    <form action="{{ URL::to('user/' . $user->id . '/edit') }}" method="post">

        <label class="note profile-note" for="note">
            Note: Fill in any fields below to update your
            <span class="fvbbc">&#35;FVBBC</span> account settings
        </label>

        <div class="field name">
            <label for="firstname">Name</label><br>

            <input type="text" name="firstname" placeholder="First"{{ (Input::old('firstname')) ? ' value="' . e(Input::old('firstname')) . '"' : '' }}>

            <input type="text" name="lastname" placeholder="Last"{{ (Input::old('lastname')) ? ' value="' . e(Input::old('lastname')) . '"' : '' }}>

            @if ($errors->has('firstname'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('firstname') }}
                </p>
            @endif

            @if(Session::has('form-message'))
                <p for="form-message" class="error">
                    <span class="error-note">&#42;&#42;&#42;&nbsp;</span>{{ Session::get('form-message') }}
                </p>
            @endif

            @if ($errors->has('lastname'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('lastname') }}
                </p>
            @endif

            @if(Session::has('form-message'))
                <p for="form-message" class="error">
                    <span class="error-note">&#42;&#42;&#42;&nbsp;</span>{{ Session::get('form-message') }}
                </p>
            @endif
        </div>

        <div class="field">
            <label for="username">Username</label><br>

            <input type="text" name="username"{{ (Input::old('username')) ? ' value="' . e(Input::old('username')) . '"' : '' }}>

            @if ($errors->has('username'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('username') }}
                </p>
            @endif
        </div>

        <div class="field">
            <label for="password">New Password</label><br>

            <input type="password" name="password">

            @if ($errors->has('password'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>

        <div class="field">
            <label for="confirmPassword">Confirm new password</label><br>

            <input type="password" name="password_confirm">

            @if ($errors->has('password_confirm'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    Passwords must match.
                </p>
            @endif
        </div>

        <div class="field email">
            <label for="email">Email address</label><br>

            <input type="email" name="email" placeholder="example@example.com"{{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>

            @if($errors->has('email'))
                <p class="error">
                    <span class="error-note">&#42;&#42;&nbsp;</span>
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>

        <div class="field size">
            <label for="size">Size</label><br>

            <input type="text" name="height" placeholder="Height (in)"{{ (Input::old('height')) ? ' value="' . e(Input::old('height')) . '"' : '' }}>

            <input type="text" name="weight" placeholder="Weight (lbs)"{{ (Input::old('weight')) ? ' value="' . e(Input::old('weight')) . '"' : '' }}>

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

        <button type="submit" class="button btn btn-lg">Update Account</button>

        {{ Form::token() }}
    </form>

@stop
