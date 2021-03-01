<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="icon" href="{{asset('images/favi.png')}}">
</head>

<body>
    <div class="container-fluid bg-white mb-3">
    <section class="loged-header" >
    <div class="container">
        <div class="header">
            <div>
                <div class="brand">
                    <a href="#">
                    <img width='120px' src="https://img.freepik.com/free-vector/quiz-comic-pop-art-style_175838-505.jpg?size=626&ext=jpg" alt="">
            </a>
                    
                </div>
            </div>
            <div>
                <ul>
                    {{--<li><a href="/how-it-works">How it works</a></li>--}}
                    <li>
                        <i class="fa fa-user"></i>
                        <a href="{{url('/quiz-user-details/my-information')}}">{{auth()->user()->username}}</a>
                    </li>
                    
                    <li>You have {{auth()->user()->credit_balance}} coins</li>
                  
                </ul>
            </div>
            @if(auth()->user())
                <div>
                    <a class="btn btn-outline-primary" href="{{ url('admin/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            @endif
        </div>
    </div>
</section>
          
    <div class="container"> 
        <div class="row bg-white">           
            <div class="col-md-2 p-3 text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLHD1iuGCfQ6y-_XWhK6O4E5vQPxpbFFmOBg&usqp=CAU"
                    class="img-fluid mb-2 img-thumbnail" alt="">
                <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt="">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLHD1iuGCfQ6y-_XWhK6O4E5vQPxpbFFmOBg&usqp=CAU"
                    class="img-fluid mb-2 img-thumbnail" alt="">
                <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt="">
            </div>
            <div class="col-md-8 border-left border-right">   
                         
                    <div class="row  border-bottom p-3 shadow-lg" style="background-color: #f2f2f2;">
                       <div class="col-md-4 d-flex align-items-center">
                           <div>
                              
                           Quiz End Date &time &nbsp;&nbsp;{{$quiz->quiz}}    <br>
                            <span class="badge badge-warning">{{date('d-M-yy / H:m', strtotime($quiz->expiry_date))}} </span> 
                           
                        </div>
                       </div>
                       <div class="col-md-4 d-flex align-items-center justify-content-center"> 
                           <img class="img-fluid" width='100px' src=" https://img.freepik.com/free-vector/quiz-comic-pop-art-style_175838-505.jpg?size=626&ext=jpg" alt="">
                       </div>
                       <div class="col-md-4 d-flex align-items-center justify-content-end">
                        <div>
                         Total participant :  <span class="badge badge-success ">{{$countAttend}}</span>
                        </div>
                       </div>
                     </div>
                     <?php $i=1 ?>
                <form action="{{url('/quiz-answer')}}" method="post" >
                    @csrf
                    <input
                                    type="hidden"
                                    id="qid"
                                    name="quiz"
                                    value="{{ $quiz->id }}">
                    <div class="row p-3">
                    @foreach($question as $quest)
                    <div class="col-sm-12 col-md-6 col-lg-3 px-1">
                        <div class="card custom-card pb-3">
                            <small class="text-center mb-2">Question-{{$i}}</small>
                            <h5 class='text-center text-capitalize qs-title'>{{$quest->question}}</h5>
                            <div class="card-body p-0  mt-4">
                                <div class='qsoptions'>

                                    <input
                                            type="hidden"
                                            id="hid"
                                            name="questions[{{ $i }}]"
                                            value="{{ $quest->id }}">

                                    <input  class="form-check-input" 
                                    type="radio" name="option{{ $quest->id }}" id="{{$i+$quest->id+1}}"
                                    value="{{$quest->option1}}">
                                    <label for='{{$i+$quest->id+1}}' class="form-check-label"> {{$quest->option1}}</label>
                                </div>
                                
                                <div class='qsoptions'>
                                    <input class="form-check-input" 
                                    type="radio"
                                    id="{{$i+$quest->id+2}}"
                                           name="option{{ $quest->id }}"
                                    value="{{$quest->option2}}">
                                    <label for='{{$i+$quest->id+2}}' class="form-check-label"> {{$quest->option2}} </label>
                                </div>
                                @if($quest->option3 != null)
                                <div class='qsoptions'>
                                    <input  class="form-check-input" 
                                    type="radio"
                                    id="{{$i+$quest->id+3}}"
                                            name="option{{ $quest->id }}"
                                    value="{{$quest->option3}}">
                                    <label for='{{$i+$quest->id+3}}' class="form-check-label"> {{$quest->option3}} </label>
                                </div>
                                @endif

                                @if($quest->option4 != null)
                                <div class='qsoptions'>
                                            <input  class="form-check-input" 
                                            type="radio"
                                            id="{{$i+$quest->id+4}}"
                                                    name="option{{ $quest->id }}"
                                            value="{{$quest->option4}}">
                                            <label for='{{$i+$quest->id+4}}' class="form-check-label"> {{$quest->option4}}</label>
                                </div>
                                @endif
                            </div>
                        </div>
                       
                    </div>
                    <?php $i++?>
                    @endforeach
                </div>
                    <button  class="btn btn-success">Submit</button>
              </form>
               
                <h5 class="mb-3mb-3 alert alert-warning">Do you want to play more quiz? </h5>
                <div class="row bg-white border-top d-flex flex-wrap p-3 text-center ">
                    @foreach($commercialQuiz as $commercial)

                  <a href="{{url('/commercial-quiz/'.$commercial->id )}}"> <button class="related-quiz ">  {{$commercial->quiz}} </button></a>
                    @endforeach
                </div>
                <h5 class="mb-3mb-3 alert alert-warning">Try Free Quiz without Prize? </h5>
                <div class="row bg-white border-top d-flex flex-wrap p-3 text-center ">
                    @foreach($freeQuiz as $free)
                    <a href="{{url('/commercial-quiz/'.$free->id )}}"> <button class="related-quiz ">  {{$free->quiz}} </button></a>
                   @endforeach
                </div>
            </div>
            <div class="col-md-2 p-3 text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLHD1iuGCfQ6y-_XWhK6O4E5vQPxpbFFmOBg&usqp=CAU"
                    class="img-fluid mb-2 img-thumbnail" alt="">
                <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt="">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLHD1iuGCfQ6y-_XWhK6O4E5vQPxpbFFmOBg&usqp=CAU"
                    class="img-fluid mb-2 img-thumbnail" alt="">
                <img class="img-fluid mb-2 img-thumbnail" src="https://static.vecteezy.com/system/resources/previews/000/580/906/non_2x/vector-creative-advertisement-banner-design.jpg" alt="">
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white mt-3">
        <div class="container">
            <div class="footer text-center p-2">
               <small>Footer</small>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>
