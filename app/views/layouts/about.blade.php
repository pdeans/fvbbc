@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/about.css') }}
@stop

@section('content')
    <div class="main-wrap">
        <h2>About <span class="fvbbc">&#35;FVBBC</span></h2>
        <div clas="clearfix">
            <img class="pull-left" src="{{ asset('static/img/about-pic.jpg') }}" alt="About Us - FVBBC">
            <p>
                The French Valley Barbell Club was founded in 2013 by a group of like minded and strong willed competitors from all walks of life. They are driven by one common goal: to push one another to reach their full potential as powerlifting athletes. They do this by constantly encouraging eachother and following consistent workout routines and nutrition programs. They continue to put in the hard work day after day and fight for every pound in the weight room. Take a look at their current workout <a href="{{ URL::to('extras/routines') }}">routine</a> to get an idea of how they program their rigorous workout schedule.
                <br>
                <br>
                Come check out a meet sometime and see them in action! Information on their upcoming meets and events can be found <a href="{{ URL::to('extras/events') }}">here</a>.
            </p>
        </div>
    </div>
@stop
