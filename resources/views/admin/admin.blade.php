<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{--<meta name="viewport" content="width=1024">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<meta name="viewport" content="width=1024">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin </title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="{{asset('sass/app.scss')}}">
    <link rel="stylesheet" href="{{asset('theme-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme-assets/css/sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/table.css')}}">
    <link rel="stylesheet" href="{{asset('css/summernote/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('css/select.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />

  


    <!-- Styles -->
</head>
<body>
    <div id="app" v-cloak >
        <div id="wrapper">
            @include('admin.includes.header')
            @yield('content')
            @include('admin.includes.footer')
            <form action="" method="post" id="deleteForm">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    {{--<script src="{{asset('js/jquery.datetimepicker.js')}}"></script>--}}
    <script src="{{asset('theme-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('theme-assets/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('theme-assets/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/table.js')}}"></script>
    <script src="{{asset('js/theme-cust.js')}}"></script>
    <script src="{{asset('js/editor.min.js')}}"></script>
    <script src="{{asset('js/select.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    @yield('scripts')
</body>
</html>
