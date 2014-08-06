<aside id="sidebar" class="sidebar hidden-sm hidden-xs">
    <h2>&#35;FVBBC Extras</h2>

    <ul class="nav nav-sidebar">

        <li {{ (Request::is('extras/events') ? ' class="sidebar-active"' : '') }} >
            <a href=" {{{ URL::to('extras/events') }}} ">
                <span class="glyphicon glyphicon-calendar"></span>Upcoming Events
            </a>
        </li>

        <li {{ (Request::is('extras/routines') ? ' class="sidebar-active"' : '') }} >
            <a href=" {{{ URL::to('extras/routines') }}} ">
                <span class="glyphicon glyphicon-th-list"></span>Current Workout Routines
            </a>
        </li>

        <li {{ (Request::is('extras/tools') ? ' class="sidebar-active"' : '') }} >
            <a href=" {{{ URL::to('extras/tools') }}} ">
                <span class="glyphicon glyphicon-wrench"></span>Training Tools
            </a>
        </li>

        <li {{ (Request::is('extras/wilks') ? ' class="sidebar-active"' : '') }} >
            <a href=" {{{ URL::to('extras/wilks') }}} ">
                <span class="glyphicon glyphicon-stats"></span>Wilks Ratings
            </a>
        </li>

    </ul>
    <div class="logo-bottom">
        <img src="{{ asset('static/img/logo-sm.png') }}" alt="FVBBC Logo">
    </div>

</aside>
