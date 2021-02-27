{{--@extends('site.app')--}}
{{--@section('title-meta')--}}
    {{--<title>Quiz Test</title>--}}
{{--@endsection--}}

{{--@section('content')--}}
<section class="quiz">


        @if(isset($msg))

            <div class="alert alert-warning "><h4>{{$msg}}</h4></div>
        @else

            @if(isset($quiz))
                @if (Carbon\Carbon::now() >$quiz[0]->expiry_date)
                    <div class="alert alert-warning  ">Sorry! The quiz has been expired!!</div>
                @else

                    <?php $i = 1; ?>


                    <br>
    <div class="quizHeader">
        {{--<div>--}}
            {{--<a class="btn btn-outline-primary" href="{{ url('admin/logout') }}"--}}
               {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                {{--Logout--}}
            {{--</a>--}}

            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
                  {{--style="display: none;">--}}
                {{--@csrf--}}
            {{--</form>--}}
        {{--</div>--}}
        @if($quizhead)
        <h2>{{$quizhead[0]->second_header}}</h2>
        @endif
        @foreach($prize as $pri)
           <h5 style="color: #2078c7 ">{{$pri->score}} OUT OF 10 <span style="color: #CB2F04">{{$pri->gift}}</span> COINS</h5>


        @endforeach
        <h3>Result Declare After &nbsp; &nbsp;<i class="fa fa-check"></i> {{ date('d-M-yy H:m', strtotime($quiz[0]->expiry_date)) }}</h3>
    </div>
                        <form action="{{url('/quiz-save')}}" method="post">
                            @csrf

    <div class="quizContainer">

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
                        name="questions[{{ $i }}]"
                        value="{{ $quest->id }}">

                <label class='qstnLabel'>
                    <input
                            type="radio"
                            name="option{{ $quest->id }}"
                            value="{{ $quest->option1 }}" required> <span> {{ $quest->option1 }}</span>
                </label>

                <label  class='qstnLabel'>
                    <input
                            type="radio"
                            name="option{{ $quest->id }}"
                            value="{{ $quest->option2 }}" required> <span> {{ $quest->option2 }} </span>
                </label>
            </div>

        </div>


        <?php $i++; ?>
    @endforeach
        <!-- card loop end here -->
    </div>

                           <br> <div align="center " class="mb-5">
                                 <button class="btn btn-success"  >Next >></button></label>
                            </div>
                        </form>
    @endif
        @endif
    @endif


</section>

{{--<script>--}}

    {{--// $(document).ready(function() {--}}
    {{--//     $('#button').hide();--}}
    {{--// });--}}



    {{--// function myFunction() {--}}
    {{--//--}}
    {{--//     $("input[type=radio]").each(function () {--}}
    {{--//--}}
    {{--//         // If radio button not checked--}}
    {{--//         // display alert message--}}
    {{--//         $('#button').show();--}}
    {{--//     });--}}
    {{--// }--}}
    {{--function myFunction() {--}}

        {{--var radio = [];--}}
        {{--var id = [];--}}

        {{--$("input[type='hidden']").each(function (index) {--}}
            {{--id.push($(this).val());--}}

        {{--});--}}

        {{--$('input:radio:checked').each(function () {--}}


            {{--radio.push($(this).val());--}}

        {{--});--}}
        {{--id.splice(0, 2);--}}
        {{--console.log(id);--}}
        {{--console.log(radio);--}}

        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}


        {{--$.ajax({--}}
            {{--url: '/quiz-save',--}}

            {{--type: 'post',--}}
            {{--cache: false,--}}
            {{--dataType: 'json',--}}
            {{--data: {--}}

                {{--id,--}}
                {{--radio,--}}


            {{--},--}}
        {{--})--}}
    {{--}--}}

{{--</script>--}}


