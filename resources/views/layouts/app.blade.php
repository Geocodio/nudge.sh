<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>nudge.sh - Super simple notifications for long-running command line tasks</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
<div class="my-8">
    @yield('content')

    <div class="text-center mt-4 text-xs text-gray-700">Made with ❤️ by <a href="http://dotsqua.re">Dotsquare</a> in Arlington, VA</div>
</div>
</body>
</html>
