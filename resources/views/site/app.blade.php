<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script type="text/javascript">
        // Get rid of the Facebook residue hash in the URI
        // Must be done in JS cuz hash only exists client-side
        // IE and Chrome version of the hack
        if (String(window.location.hash).substring(0,1) == "#") {
            window.location.hash = "";
            window.location.href=window.location.href.slice(0, -1);
        }
        // Firefox version of the hack
        if (String(location.hash).substring(0,1) == "#") {
            location.hash = "";
            location.href=location.href.substring(0,location.href.length-3);
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<meta name="viewport" content="width=1024">--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"           content="http://127.0.0.1:8000/promotion-video" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Galaxy.Games" />
    <meta property="og:description"   content="Please visit the site" />
    <meta property="og:video"         content="http://127.0.0.1:8000/promotion-video" />

    @yield('title-meta')
    <meta http-equiv="refresh" content="900"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/smoothproducts.css')}}">
    <link rel="icon" href="{{asset('images/favi.png')}}">
    {{--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>--}}

    <!-- Styles -->
    @php
        $date = new DateTime(); $serverTime = $date->format('Y-m-d H:i:s');
        $timeZone = $date->getTimezone()->getName();
    @endphp

    <script>
        window.serverTime = "{{ $serverTime }}";
        window.auth = "{{request()->user()}}";
        window.currentPath = "{{request()->path()}}";
        window.allAuctionSetTimout=[];
        window.timeZone="{{$timeZone}}";
    </script>
</head>
<body>

<div id="app" v-cloak>
    @if(session('message'))
        <div class="flash-message">
            @if(session('type')=='success')
                <div class="alert alert-warning" role="alert" id="successMessage">
                    @else
                        <div class="alert alert-danger " role="alert" id="successMessage">
                            @endif

                            {{--<h4 class="alert-heading w-capitalize">{{session('type')}} !</h4>--}}
                            <p class="w-capitalize">{{session('message')}}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                </div>
        </div>
    @endif

    @yield('content')
   

</div>

{{--<div class="loader-container" id="preload">--}}
{{--<div class="loader-logo">--}}
{{--<div class="loader-circle"></div>--}}
{{--</div>--}}
{{--</div>--}}







@yield('scripts')
{{--<script src="{{asset('js/jquery.min.js')}}"></script>--}}
<script src="{{asset('js/smoothproducts.min.js')}}"></script>
{{--<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>--}}

<script src="{{mix('js/app.js')}}"></script>
<script src="{{asset('js/zoom-image.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/custom.js')}}"></script>


</body>
</html>
