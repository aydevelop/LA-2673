<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">    
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>

</head>
<body>
    <div id="app" class="container">
        @include('includes.header')
        <main class="py-4">
            @yield('content')
        </main>
        @include('includes.footer')
    </div> 

	<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    @yield('footer-scripts')
</body>
</html>
