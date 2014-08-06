@extends('layouts.base')

@section('head')
   {{ HTML::style('static/css/contact.css') }}
@stop

@section('content')
   <div class="main-wrap">
      <h2>Contact <span class="fvbbc">&#35;FVBBC</span></h2>
      <ul class="contact">
         <li>
            <a href="https://www.youtube.com/user/hdote50" target="_blank">
               <img src="{{ asset('static/img/youtube-button.png') }}" alt="Youtube Logo">
            </a>
            <h4>YouTube:</h4>
            <a href="https://www.youtube.com/user/hdote50" target="_blank">youtube.com/user/hdote50</a>
         </li>
      </ul>
   </div>
@stop
