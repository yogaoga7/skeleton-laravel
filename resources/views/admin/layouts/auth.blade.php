<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{  asset('/css/admin.css') }}">

    @stack('styles')
</head>

<body>
    @yield('content')
  
    <script src="{{ asset('/js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>
