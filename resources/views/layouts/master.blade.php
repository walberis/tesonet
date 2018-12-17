<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Testio</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


    <!-- Styles -->
    @push('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endpush
    <!-- Scripts -->
    @push('scripts')
    <link href="{{ asset('js/app.js') }}" rel="text/javascript">
    @endpush

    @stack('styles')
    @stack('scripts')


</head>
<body>

<div class="container-fluid ">
    @yield('content')
</div>

</body>

</html>