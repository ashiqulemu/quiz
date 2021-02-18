@extends('site.qapp')
@section('title-meta')
    <title>Galaxy user loged </title>
@endsection

@section('content')
    @include('.site.login.user.quiz.header')
    @include('site.login.login-partitial.quiz.quiz-button')

    <section class="myFirebidder">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Edit Quiz</h2>
                <hr>
            </div>
            <div class="col-lg-3">
                @component('site.login.user.quiz.leftBar') @endcomponent
            </div>


            <div class="col-lg-9 p-0">
                @if(!empty($msg))

                    <div class="alert alert-warning "><h4>{{$msg}}</h4></div>
                @else
                <table class="table table-striped">
                    <thead>
                    <th> Quiz</th>
                    <th> Action</th>
                    </thead>
                <?php for($i=0;$i<sizeof($quiz);$i++) { ?>
                    <tbody>
                @if(Carbon\Carbon::now() > $quiz[$i]->expiry_date)

                      <tr>
                          <td>  <h4> {{ date('d-M-yy H:m', strtotime($quiz[$i]->expiry_date)) }} quiz has expired.</h4></td>

                   <td> NO EDIT</td>
                      </tr>
                   </tbody>
                @else


                       <tr>
                           <td>
                           <h4>{{ date('d-M-yy H:m', strtotime($quiz[$i]->expiry_date)) }} quiz</h4>
                           </td>

                      <td>
                            <form action="{{url('/quiz/edit/'.$quiz[$i]->id)}}" method="get">

                                <button class="btn btn-success">
                                    Edit
                                </button>

                            </form>
                      </td>
                       </tr>
                       </tbody>

                     @endif
                    <?php };?>
                </table>
                @endif
                    </div>

                </div>

    </div>



    </section>

@endsection