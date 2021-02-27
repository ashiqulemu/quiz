
<section>
    <div class="quiz">

        @if(!empty($msg))

            <div class="alert alert-warning "><h4>{{$msg}}</h4></div>
        @else

            @if(isset($quiz))
                @if (Carbon\Carbon::now() >$quiz[0]->expiry_date)
                    <div class="alert alert-warning  ">Sorry! The quiz has been expired!!</div>
                @else


                    <?php $i = 1; ?>


                    <br>
                    <div class="quizHeader">
                        {{--@foreach($quizHead as $head)--}}
                            {{--<h2>{{$head->first_header}}</h2>--}}
                            {{--<h5 style="color: #2078c7 ">{{$head->second_header}}</h5>--}}
                        {{--@endforeach--}}

                        <h4>Result Declare After &nbsp; &nbsp;<i class="fa fa-check"></i> {{ date('d-M-yy H:m', strtotime($quiz[0]->expiry_date)) }}</h4>
                    </div>
                    <form action="{{url('/quiz-save')}}" method="post" >
                        @csrf

                        <div class="quizContainer">
                            <input
                                    type="hidden"
                                    id="qid"
                                    name="quiz"
                                    value="{{ $quiz[0]->id }}">
                        @foreach($question as $quest)

                            <!-- card loop from here -->
                                <div class="quiestionBar">
                                    <div class='serial'>
                                        <div class='inner'>
                                            Questions:{{$i}} <br>
                                            {{  date('h.i a  M d,yy ',strtotime(Carbon\Carbon::now())) }}
                                        </div>
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

                        <br> <div align="center ">
                            <button class="btn btn-success" >Next >></button></label>
                        </div>
                    </form>
                @endif
            @endif
        @endif

    </div>

</section>

{{--<script>--}}



    {{--window.onpageshow = function(evt) {--}}
        {{--// If persisted then it is in the page cache, force a reload of the page.--}}
        {{--if (evt.persisted) {--}}
            {{--document.body.style.display = "none";--}}
            {{--location.reload();--}}
        {{--}--}}
    {{--};--}}

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
        {{--var quizid= $('#qid').val();--}}


        {{--$("input[type='hidden']").each(function (index) {--}}
            {{--id.push($(this).val());--}}

        {{--});--}}

        {{--$('input:radio:checked').each(function () {--}}


            {{--radio.push($(this).val());--}}

        {{--});--}}
        {{--id.splice(0, 3);--}}

        {{--console.log(quizid);--}}
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
                {{--quizid,--}}


            {{--},--}}
        {{--})--}}
    {{--}--}}

{{--</script>--}}