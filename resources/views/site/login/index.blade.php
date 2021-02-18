@extends('site.app')
@section('title-meta')
    <title>Galaxy </title>
@endsection

@section('content')

    @include('site.login.login-partitial.header')
   <br>
   @if (!($countPost)|| $countPost<1)

    <button onclick="myFunction()" class="fa fa-facebook-square" style="color: #005cbf">Share</button>


    @else
        <button onclick="myFunction()" id="form"  class="fa fa-facebook-square" disabled>Share</button>
    @endif
    @include('site.home-partials.chat-message')
    @include('site.login.login-partitial.quiz.loggedin_quiz')
    {{--@include('site.login.login-partitial.slider')--}}
    @include('.site.login.login-partitial.nav')
    @include('site.home-partials.auction-bar')


    @include('site.home-partials.auction-products')
    @include('site.home-partials.up-coming-auction-bar')

   {{-- Up Commint AUCTIONS PRODUCTS--}}

   @include('site.home-partials.up-coming-auction')
   {{--Regular products--}}

   @include('site.home-partials.regular-product')
    {{--products--}}
   @include('site.home-partials.closed-product-bar')

   @include('site.home-partials.closed-products')

    {{--@include('.site.home-partials.featuredProduct')--}}

{{--    @include('site.home-partials.scroller')--}}









@endsection



@section('scripts')
@endsection
        <script>
            $count = 0;
            function myFunction() {

                 // document.getElementById("socialModal").style.cssText="display:flex!important;"

                if ($count <= 1)
                {
                    $count++;

                    //     // var x = document.URL;

                    $.ajax({

                        url: "count/fb",
                        type: "post",
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                    });

                    var windowOptions = "toolbar=no,location=no,status=no,menubar=no,scrollbars=no,height=400,width=400,left=300,top=150"
                    window.open("http://www.facebook.com/sharer.php?u=https://galaxy.games/promotion-video", "", windowOptions);




                    // window.open('http://www.facebook.com/sharer.php?,','sharer','toolbar=0,status=0,width=626,height=436');return false;
                //
                }
            else{
                    document.getElementById("form").disabled = true;
                }
            }
        </script>

