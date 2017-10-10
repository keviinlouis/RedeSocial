<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('js/arrive.min.js') }}" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="{{ asset('js/es6-promise-auto.min.js') }}"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
    <script src="{{ asset('js/chartist.min.js') }}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>
    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <!--   Sharrre Library    -->
    <script src="{{ asset('js/jquery.sharrre.js') }}"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('js/jquery-jvectormap.js') }}"></script>
    <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFPQibxeDaLIUHsC6_KqDdFaUdhrbhZ3M"></script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('js/jquery.select-bootstrap.js') }}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/jquery.datatables.js') }}"></script>
    <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('js/jquery.tagsinput.js') }}"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('js/material-dashboard.js?v=1.2.0')}}"></script>

</body>
</html>
