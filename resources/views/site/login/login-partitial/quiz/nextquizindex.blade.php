@extends('site.app')
@section('title-meta')
    <title>Glaxy User Logged in </title>
@endsection

@section('content')

    @include('site.login.login-partitial.quiz.logedin_header')
    @include('site.login.login-partitial.quiz.quiz-button')
    <br>
    @if (isset($countPost))
        @if($countPost<1)

            <button onclick="myFunction()" class="fa fa-facebook-square" style="color: #005cbf">Share</button>


        @else
            <button onclick="myFunction()" id="form"  class="fa fa-facebook-square" disabled>Share</button>
        @endif
    @endif

    @include('site.login.login-partitial.quiz.nextloggedin')


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
            window.open("http://www.facebook.com/sharer.php?u=https://galaxy.auction", "", windowOptions);




            // window.open('http://www.facebook.com/sharer.php?,','sharer','toolbar=0,status=0,width=626,height=436');return false;
            //
        }
        else{
            document.getElementById("form").disabled = true;
        }
    }
</script>

