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

                <div class="col-lg-9">
                    <div class="quiz">
                        @if(isset($msg))
                            <div class="label-danger">{{$msg}}</div>
                            @endif

                            <?php $i = 1;$ch="checked"; ?>


                            <br>
                            <div class="quizHeader">

                                <h3>{{ date('d-M-yy H:m', strtotime($quiz[0]->expiry_date)) }} Quiz Edit</h3>
                                <br>
                                <h3>Your Answer </h3>
                            </div>
                            <form action="{{url('/quiz-update/'.$quiz[0]->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="quizContainer">
                                @if($question)

                                    @foreach($question as $quest)

                                        <!-- card loop from here -->
                                            <div class="quiestionBar">
                                                <div class='serial'>

                                                    <div> Questions:{{$i}}</div>
                                                    <div>{{  date('h.i a  M d,yy ',strtotime(Carbon\Carbon::now())) }}</div>

                                                </div>
                                                <div class="question">
                                                    <p>{!! nl2br($quest->question) !!}</p>
                                                </div>
                                                <div class="options">

                                                    <input
                                                            type="hidden"
                                                            id="hid"
                                                            name="aid[{{ $i }}]"
                                                            value="{{ $fcheck[$i-1]->id }}">
                                                    <input
                                                            type="hidden"
                                                            id="hid"
                                                            name="questions[{{ $i }}]"
                                                            value="{{ $quest->id }}">

                                                    <label class='qstnLabel'>


                                                        <input
                                                                type="radio"
                                                                name="option{{ $quest->id }}"
                                                                value="{{ $quest->option1 }}" required

                                                        @if($fcheck[$i-1]->answer == $quest->option1)
                                                        {{$ch}} @endif
                                                        >
                                                        <span> {{ $quest->option1 }}</span>
                                                    </label>

                                                    <label  class='qstnLabel'>
                                                        <input
                                                                type="radio"
                                                                name="option{{ $quest->id }}"
                                                                value="{{ $quest->option2 }}" required
                                                        @if($fcheck[$i-1]->answer == $quest->option2)
                                                            {{$ch}} @endif
                                                        >
                                                        <span> {{ $quest->option2 }} </span>
                                                    </label>

                                                </div>

                                            </div>


                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                                <!-- card loop end here -->
                                </div>

                                <br> <div align="center " class="mb-5">
                                    <button class="btn btn-success">Update >></button></label>
                                </div>
                            </form>



                </div>
            </div>
        </div>
        </div>
    </section>
@endsection



