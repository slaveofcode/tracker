<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle') - Tracker</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ elixir('css/main.css') }}">
        @section('head')
        @show
    </head>
    <body>
        <div class="container-fluid">
            @section('container')
            @show
        </div>
        <script src="{{ elixir('js/app.js') }}"></script>
    </body>
</html>
