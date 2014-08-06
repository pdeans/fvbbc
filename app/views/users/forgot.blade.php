@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/create.css') }}
@stop

@section('content')
   <h2>Forgot your <span class="fvbbc">&#35;FVBBC</span> Account password?</h2>

   <form action="{{ URL::route('user-forgot-password-post') }}" method="post">
      <div class="field recover">
         <label class="recover-note">
             Enter e-mail address below to recover account.
         </label>
         <label>
            Email
         </label>
         <input type="text" name="email"{{ (Input::old('email')) ? ' value="' . e(Input::old('email')) . '"' : '' }}>
         @if ($errors->has('email'))
            <p class="error">
               <span class="error-note">&#42;&#42;&nbsp;</span>
               {{ $errors->first('email') }}
            </p>
         @endif
      </div>

      <button type="submit" class="btn btn-lg">Recover</button>

      {{ Form::token() }}
   </form>
@stop
