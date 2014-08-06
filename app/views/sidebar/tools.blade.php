@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/tools.css') }}
@stop

@section('content')
    <div class="main-wrap">

      <h2><span class="fvbbc">&#35;FVBBC</span> Training Tools</h2>

      <form class="form-horizontal" action="{{ URL::route('tools-post') }}" method="post" role="form">
         <div class="form-group">
           <label class="col-sm-7 text-right"><h3>Max-rep Calculator</h3></label>
         </div>
         <div class="form-group clearfix">
            <label class="col-sm-4 control-label">
               Weight Lifted
            </label>
            <div class="col-sm-3">
               <input class="form-control" type="text" name="mr_weight"{{ (Input::old('mr_weight')) ? ' value="' . e(Input::old('mr_weight')) . '"' : '' }}>
            </div>
            @if ($errors->has('mr_weight'))
             <div class="error">
                 <span class="error-note">&#42;</span>
                  {{ $errors->first('mr_weight') }}
             </div>
            @endif
         </div>

         <div class="form-group clearfix">
            <label class="col-sm-4 control-label">
               Number of Reps
            </label>
            <div class="col-sm-3">
               <input class="form-control" type="text" name="mr_reps"{{ (Input::old('mr_reps')) ? ' value="' . e(Input::old('mr_reps')) . '"' : '' }}>
            </div>
            @if ($errors->has('mr_reps'))
             <div class="error">
                 <span class="error-note">&#42;</span>
                  {{ $errors->first('mr_reps') }}
             </div>
            @endif
         </div>

         <div class="form-group clearfix">
            <label class="col-sm-4 control-label">
               Projected Max
            </label>
            <div class="col-sm-3">
               <input class="form-control answer" type="text"{{ Session::has('mr_total') ? ' value="' . e(Session::get('mr_total')) .  '" autofocus' : '' }}>
            </div>
         </div>

         <div class="form-group">
            <div class="col-sm-offset-4 col-sm-3">
               <button type="submit" class="btn">Calculate</button>
            </div>
         </div>

         {{ Form::token() }}
      </form>

      <form class="form-horizontal" action="{{ URL::route('tools-post') }}" method="post" role="form">
         <div class="form-group">
           <label class="col-sm-7 text-right"><h3>Lbs <span class="glyphicon glyphicon-resize-horizontal"></span> Kg Converter</h3></label>
         </div>
         <div class="form-group clearfix">
            <label class="col-sm-4 control-label">
               Weight
            </label>
            <div class="col-sm-3">
               <input class="form-control" type="text" name="conv_weight"{{ (Input::old('conv_weight')) ? ' value="' . e(Input::old('conv_weight')) . '"' : '' }}>
            </div>
            @if ($errors->has('conv_weight'))
             <div class="error">
                 <span class="error-note">&#42;</span>
                  {{ $errors->first('conv_weight') }}
             </div>
            @endif
         </div>

         <div class="form-group form-radio">
            <label class="radio col-sm-offset-4 col-sm-3">
               <input type="radio" name="conv_choice" value="lbs" checked>Lbs to Kg
            </label>
         </div>

         <div class="form-group form-radio-last">
            <label class="radio col-sm-offset-4 col-sm-3">
               <input type="radio" name="conv_choice" value="kg">Kg to Lbs
            </label>
         </div>

         <div class="form-group clearfix">
            <label class="col-sm-4 control-label">
               Results
            </label>
            <div class="col-sm-3">
               <input class="form-control answer" type="text"{{ Session::has('conv_total') ? ' value="' . e(Session::get('conv_total')) .  '" autofocus' : '' }}>
            </div>
         </div>

         <div class="form-group">
            <div class="col-sm-offset-4 col-sm-3">
               <button type="submit" class="btn">Convert</button>
            </div>
         </div>

         {{ Form::token() }}
      </form>

      <form class="form-horizontal" action="{{ URL::route('tools-post') }}" method="post" role="form">
         <div class="form-group">
           <label class="col-sm-7 text-right"><h3>Wilks Rating Calculator</h3></label>
         </div>
         <div class="form-group clearfix">
            <label for="wilks_lifted" class="col-sm-4 control-label">
               Total Lifted (lbs)
            </label>
            <div class="col-sm-3">
               <input class="form-control" type="text" name="wilks_lifted"{{ (Input::old('wilks_lifted')) ? ' value="' . e(Input::old('wilks_lifted')) . '"' : '' }}>
            </div>
            @if ($errors->has('wilks_lifted'))
             <div class="error">
                 <span class="error-note">&#42;</span>
                  {{ $errors->first('wilks_lifted') }}
             </div>
            @endif
         </div>

         <div class="form-group clearfix">
            <label for="wilks_bweight" class="col-sm-4 control-label">
               Bodyweight (lbs)
            </label>
            <div class="col-sm-3">
               <input class="form-control" type="text" name="wilks_bweight"{{ (Input::old('wilks_bweight')) ? ' value="' . e(Input::old('wilks_bweight')) . '"' : '' }}>
            </div>
            @if ($errors->has('wilks_bweight'))
             <div class="error">
                 <span class="error-note">&#42;</span>
                  {{ $errors->first('wilks_bweight') }}
             </div>
            @endif
         </div>

         <div class="form-group form-radio">
            <label class="radio col-sm-offset-4 col-sm-3">
               <input type="radio" name="wilks_gender" value="male" checked>Male
            </label>
         </div>

         <div class="form-group form-radio-last">
            <label class="radio col-sm-offset-4 col-sm-3">
               <input type="radio" name="wilks_gender" value="female">Female
            </label>
         </div>

         <div class="form-group clearfix">
            <label class="col-sm-4 control-label">
               Rating
            </label>
            <div class="col-sm-3">
               <input class="form-control answer" type="text"{{ Session::has('wilks_total') ? ' value="' . e(Session::get('wilks_total')) .  '" autofocus' : '' }}>
            </div>
         </div>

         <div class="form-group">
            <div class="col-sm-offset-4 col-sm-3">
               <button type="submit" class="btn">Calculate</button>
            </div>
         </div>

         {{ Form::token() }}
      </form>

    </div>
@stop
