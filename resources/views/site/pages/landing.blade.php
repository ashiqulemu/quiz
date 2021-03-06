<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="icon" href="{{asset('images/favi.png')}}">
</head>

<body>
    <div class="container-fluid bg-white mb-3">
        <nav class="navbar navbar-expand-md ">
            <a class="navbar-brand" href="#">
                <img width='120px' src="https://img.freepik.com/free-vector/quiz-comic-pop-art-style_175838-505.jpg?size=626&ext=jpg" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" id="navbarsExample04">
              <!-- <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>  
              </ul>              -->
              <div class="form-inline my-2 my-md-0 mx-auto">
                 <div class="authentication">
                   <div class='content'>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login </a> 
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                        </li> 
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active form_tab" id="login" role="tabpanel" aria-labelledby="login-tab">
                       
                        <div class="form-group">   
                        <form method="POST" action="{{ url('/admin/login') }}" class="form-group" >
                        @csrf              
                                
                                <input id="email"
                                               type="text"
                                               class="form-control{{ $errors->has('username') ||
                                               $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="Username or email"
                                               aria-describedby="emailHelp"
                                               name="login" value="{{ old('username') ?: old('email')
                                                }}" required autofocus>
                                        @if ($errors->has('username') || $errors->has('email'))
                                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('username') ?:
                                    $errors->first('email') }}</strong>
                                            </span>
                                        @endif


                              </div>
                              <div class="form-group">                               
                                
                                <input id="exampleInputPassword1"
                                           type="password"
                                           class="form-control @error('password') is-invalid
                                               @enderror"
                                           name="password"
                                           required
                                           autocomplete="current-password"
                                           placeholder="Password">
                              </div>
                              <input type="hidden" name="from" value="st">
                            <button type="submit" class="mt-2 btn btn-primary">Login</button>
                            </form>
                        </div>
                    
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <div class="tab-pane fade show active form_tab" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <div class="form-group">                              
                                    <input type="email" placeholder="Email" class="form-control" id="email" aria-describedby="emailHelp"> 
                                  </div>
                                  <div class="form-group">                               
                                    <input type="password" placeholder="password" class="form-control" id="exampleInputPassword1">
                                  </div>
                                  <button type="submit" class="ml-2 mt-2 btn btn-primary">register</button>
                            </div>
                        </div> 
                      </div>
                   </div>
                   <div class="social-login ml-2">
                       <button class="btn btn-primary">login with Facebook</button>
                   </div>
                 </div>
              </div>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">{{$quiz->quiz}} </a>
                </li> 
              </ul>  
            </div>
          </nav>
    </div>
    <div class="container"> 
    @if($errors->any())
                <div  class="alert alert-warning"><h5 style="color:#000000;font-family: Aparajita">{{$errors->first()}}</h5></div>
            @endif
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
