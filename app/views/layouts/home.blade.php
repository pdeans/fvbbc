@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/home.css') }}
@stop

@section('background-pic')
    <section class="background-pic hidden-sm hidden-xs">
        <!-- Jumbotron pic-->
        <div style="background:url(../static/img/main_bg.png) center center;background-size:cover;" class="jumbo">

        </div>
    </section>
@stop

@section('content')
    <div class="main-wrap">
        <h2>Welcome to the <span class="fvbbc">&#35;FVBBC</span> training center!</h2>

        <div class="row intro">
            <h3 class="hidden-sm hidden-xs"><span>What We Do</span></h3>

            <div class="col-md-4 intro-panel-wrap">
                <h4 class="fvbbc">We Plan</h4>
                <div class="intro-panel">
                    <p>
                        We stay up to date in the world of powerlifting science by researching and implementing the latest proven lifting techniques and nutritional advice.
                    </p>
                </div>
            </div>
            <div class="col-md-4 intro-panel-wrap">
                <h4 class="fvbbc">We Train</h4>
                <div class="intro-panel">
                    <p>
                        We test our grit and give max effort all in the name of making gains. This is where heart &amp; perseverance reign supreme and true powerlifters are made.
                    </p>
                </div>
            </div>
            <div class="col-md-4 intro-panel-wrap">
                <h4 class="fvbbc">We Compete</h4>
                <div class="intro-panel last">
                    <p>
                        This is what it's all about. Countless hours of grueling workouts and sacrifice put to the test to see how we're progressing and where we rank amongst our peers.
                    </p>
                </div>
            </div>
            <div class="intro-panel-link-wrap">
                <a href="{{{ URL::route('about') }}}" class="intro-panel-link">Learn more about &#35;FVBBC
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a><br>

                <a href="{{{ URL::to('extras/events') }}}" class="intro-panel-link">See us in action
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a><br>

                <a href="https://www.youtube.com/user/hdote50" target="_blank" class="intro-panel-link">
                    Check out our
                    <img src="{{ asset('static/img/youtube-logo.png') }}" alt="Youtube Logo"> channel
                    <span class="glyphicon glyphicon-chevron-right"></span><br>
                </a>
            </div>
        </div>
    </div>

    <div class="main-wrap photo-gallery">
        <h2><span class="fvbbc">&#35;FVBBC</span> Photo Gallery</h2>
        <h5>Latest Pics</h5>
        <div id="photo-slide" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#photo-slide" data-slide-to="0" class="active"></li>
                <li data-target="#photo-slide" data-slide-to="1"></li>
                <li data-target="#photo-slide" data-slide-to="2"></li>
                <li data-target="#photo-slide" data-slide-to="3"></li>
                <li data-target="#photo-slide" data-slide-to="4"></li>
                <li data-target="#photo-slide" data-slide-to="5"></li>
                <li data-target="#photo-slide" data-slide-to="6"></li>
            </ol>

            <div class="carousel-inner">
                <div class="item active">
                    <div style="background:url(../static/img/caro-rack.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div style="background:url(../static/img/caro-bench.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div style="background:url(../static/img/caro-compsquat.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div style="background:url(../static/img/caro-compdeadlift.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div style="background:url(../static/img/caro-medal.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div style="background:url(../static/img/caro-medal2.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div style="background:url(../static/img/caro-selfie.png) center center;background-size:cover;"
                         class="caro-style">
                        <div class="carousel-caption">
                            <p>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <a class="left carousel-control" href="#photo-slide" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#photo-slide" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
@stop
