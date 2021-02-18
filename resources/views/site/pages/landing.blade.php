<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galaxy</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="icon" href="images/land/galaxy.jpg">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />

    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
</head>
<body>


@if(auth()->user())
<form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button>logout</button>
                        </form>
                        @endif
<section class="banner">
    <div class="contentContainer">
                <a href="{{url('/quiz-start')}}">
                    <img src="images/land/3.png" class="btn-img">
                </a>
                <a href="{{url('/auction')}}">
                    <img src="images/land/4.png" class="btn-img">
                </a>
                <a href='#'>
                    <img src="images/land/1.png" class="btn-img">
                </a>
                <a href='#'>
                    <img src="images/land/2.png" class="btn-img">
                </a>
            </div>


</section>

</body>
</html>