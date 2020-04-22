<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="shortcut icon" href="{{ asset('storage/img/lightbulb.png') }}">
    <title>Pointage OXYNE - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/mdb.lite.css')}}" rel="stylesheet">
    <link href="{{asset('css/mdb.lite.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/mdb.css')}}" rel="stylesheet">
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/addons/jquery.zmd.hierarchical-display.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/addons/flag.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/addons/directives.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/addons/rating.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/modules/animations-extended.min.css')}}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- script -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/mdb.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/popper.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/addons/jquery.zmd.hierarchical-display.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/addons/directives.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/addons/flag.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/addons/imagesloaded.pkgd.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/addons/masonry.pkgd.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/modules/animations-extended.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/modules/forms-free.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/modules/scrolling-navbar.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/modules/treeview.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/modules/wow.min.js') }}" defer></script>
    <script type="text/javascript" src="{{asset('js/home.js')}}" defer></script>


</head>
    <body>
        @section('navbar')
            @include('layouts.navbar')
        @show
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                </div>
            @endif
            @if ($message = Session::get('deleted'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                </div>
            @endif
            @if ($message = Session::get('cancel'))
                <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                </div>
            @endif
            @yield('content')
        </div>
    </body>

    @section('footer')
        @include('layouts.footer')
    @show

</html>
