@extends('site.app')
@section('title-meta')
    <title>Galaxy </title>
@endsection

@section('content')

    @include('site.login.login-partitial.quiz.header')
   <br>
  
    
  
    @include('site.login.login-partitial.quiz.loggedin_quiz')
    

)










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

