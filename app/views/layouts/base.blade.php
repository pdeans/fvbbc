<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>
            @section('title')
                FVBBC - French Valley Barbell Club
            @show
        </title>

        <!-- favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('static/img/apple-touch-icon.png') }}">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('static/img/apple-touch-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('static/img/apple-touch-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('static/img/apple-touch-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('static/img/apple-touch-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('static/img/apple-touch-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('static/img/apple-touch-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('static/img/apple-touch-icon-152x152.png') }}">
        <!-- Stylesheeets -->
        {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('static/css/base.css') }}

        @yield('head')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Header -->
        <header class="navbar clearfix">
            <div class="logo"><img src="{{ asset('static/img/logo.png') }}" alt="FVBBC Logo"></div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="car car-icon pull-right">&nbsp;&#x25BC;</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
            <nav class="navbar-collapse collapse nav-wrap">
                <ul class="nav navbar-nav">
                    <li class="blank"><a></a></li>

                    <li {{ (Request::is('/') ? ' class="active"' : '') }} >
                        <a href="{{{ URL::route('home') }}}">Home</a>
                    </li>

                    <li {{ (Request::is('about') ? ' class="active"' : '') }} >
                        <a href="{{{ URL::route('about') }}}">About</a>
                    </li>

                    <li {{ (Request::is('blog') ? ' class="active"' : '') }} >
                        <a href="{{{ URL::route('blog') }}}">Blog</a>
                    </li>

                    <li {{ (Request::is('contact') ? ' class="active"' : '') }} >
                        <a href="{{{ URL::route('contact') }}}">Contact</a>
                    </li>

                    <li class="blank"><a></a></li>
                </ul>
            </nav>

            <div class="user-nav clearfix">
                <ul>
                    @if(Auth::check())
                        <div class="dropdown user-options current">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span> {{{ Auth::user()->username }}}
                                <span class="car"> &#x25BC;</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right user-options-menu" role="user-menu">
                                <li>
                                    <a href="{{{ URL::to('user/profile') }}}">
                                        <span class="fvbbc">&#35;FVBBC</span> User Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{{ URL::route('user-sign-out') }}}">Logout</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- Login button and dropdown form -->
                        <li class="login">
                            <a href="{{{ URL::route('user-sign-in') }}}">Sign in</a>
                        </li>
                        <li class="register">
                            <a href="{{{ URL::route('user-create') }}}">Sign up</a>
                        </li>
                    @endif
                </ul>
            </div>
        </header>

        <!-- Message display -->
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif

        <!-- Background picture -->
        @yield('background-pic')

        <!-- Sidebar left-->
        @include('sidebar.sidebar_left')

        <!-- Sidebar right -->
        @include('sidebar.sidebar_right')

        <!-- Main content -->
        <div class="container clearfix">

            <h1>
                <span class="title">F</span>rench
                <span class="title">V</span>alley
                <span class="title">B</span>ar<span class="title-sub">B</span>ell
                <span class="title">C</span>lub
            </h1>

            <section class="main-content">
                @yield('content')
            </section>

        </div>

        <!-- Footer -->
        <footer class="clearfix">
            <div class="sitemap pull-right">
                <ul>
                    <li>
                        Sitemap:
                    </li>
                    <li {{ (Request::is('/') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::route('home') }}}">Home</a>
                    </li>
                    <li {{ (Request::is('about') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::route('about') }}}">About</a>
                    </li>
                    <li {{ (Request::is('blog') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::route('blog') }}}">Blog</a>
                    </li>
                    <li {{ (Request::is('extras/events') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::to('extras/events') }}}">Events</a>
                    </li>
                    <li {{ (Request::is('extras/routines') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::to('extras/routines') }}}">Routines</a>
                    </li>
                    <li {{ (Request::is('extras/tools') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::to('extras/tools') }}}">Tools</a>
                    </li>
                    <li {{ (Request::is('extras/wilks') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::to('extras/wilks') }}}">Wilks Ratings</a>
                    </li>
                    <li {{ (Request::is('contact') ? ' class="sitemap-active"' : '') }} >
                        <a href="{{{ URL::route('contact') }}}">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="copyright">
                <p>
                    &copy; FVBBC 2014. All rights reserved.
                </p>
            </div>

            <div class="webmaster">
                <p>
                    Site designed, developed, and maintained by
                    <a href="http://patrickstearns.com" target="_blank">Patrick Stearns</a>.&nbsp;
                    To contact, <a href="mailto:pdeans1986@gmail.com">click here</a>.
                </p>
            </div>
        </footer>

        <!-- JavaScript -->
            {{ HTML::script('http://code.jquery.com/jquery-1.10.2.min.js') }}
            {{ HTML::script('packages/bootstrap/js/bootstrap.min.js') }}
            {{ HTML::script('static/js/custom.js') }}
    </body>
</html>
