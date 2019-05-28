<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script
            src="//code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
</head>
<body>
    <div class="container">

        <a href="/" class="btn btn-primary">На главную</a>
        <a href="{{route('form')}}" class="btn btn-primary">Добавить объявление</a>

        @yield('content')
    </div>
</body>
<script src="{{asset('js/script.js')}}"></script>
</html>