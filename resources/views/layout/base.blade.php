<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('pageTitle') - Tracker</title>
        <!-- Fonts -->
        <link href="{{ asset('img/favicon.ico') }}" rel="shortcut icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ elixir('css/main.css') }}">
        @section('head')
        @show
    </head>
    <body>
        <div class="container-fluid">
            @section('container')
            @show
        </div>
        <div id="tracker-menu-container">
            <a href="{{ action('HomeController@index') }}" title="Create new Tracker">
                <span class="glyphicon glyphicon-home"></span>
            </a>
            @unless (Auth::check())
                <a href="{{ route('googleAuth') }}" title="Login with Google Account">
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            @endunless
            @if (Auth::check())
                <a href="{{ route('logout') }}" title="Logout">
                    <span class="glyphicon glyphicon-off"></span>
                </a>
            @endif
            
        </div>
        @section('script_init')
        @show
        <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/vue/dist/vue.min.js') }}"></script>
        <script src="{{ asset('vendor/autosize/dist/autosize.min.js') }}"></script>
        <script src="{{ elixir('js/app.js') }}"></script>
        @section('script_append')
        @show
    </body>
</html>
