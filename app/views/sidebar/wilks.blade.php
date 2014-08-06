@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/wilks.css') }}
@stop

@section('content')
    <div class="main-wrap">
        <h2><span class="fvbbc">&#35;FVBBC</span> Wilks Ratings</h2>

        <div class="rankings">
            <h4>Member Rankings</h4>

            <table class="table table-striped table-condensed table-responsive">
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Gender</th>
                    <th>Big 3 Total</th>
                    <th>Wilks Rating</th>
                </tr>

            @foreach($wilks as $w)
                <tr>
                    <td class="rank">{{{ ++$rank }}}</td>
                    <td>{{{ $w->username }}}</td>
                    <td>{{{ $w->firstname }}}</td>
                    <td>{{{ $w->lastname }}}</td>
                    <td>{{{ $w->formatHeight($w->height) }}}</td>
                    <td>{{{ $w->weight }}}</td>
                    <td>{{{ $w->gender }}}</td>
                    <td>{{{ $w->big_three }}}</td>
                    <td class="rating">{{{ $w->wilks_rating }}}</td>
                </tr>
            @endforeach

            </table>

            <p>
                Want to see how you fare on the rankings board?&nbsp;
                <a href="{{{ URL::route('user-create') }}}">Sign up</a>
                 today, and make sure to fill out your current weight and Big 3 total.
            </p>
        </div>

    </div>
@stop
