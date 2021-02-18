@extends('admin.admin')

@section('content')
    <div id="page-wrapper">
        <!-- /.row -->
        <div class="row reportPanels" style="padding-top: 30px">

            <div class="col-md-12">
                <div class="card">
                    <h4 class="well well-sm">Edit & Upade Quiz</h4>
                    <div class="panel-subheading ">
                       Current Quiz: <div class="badge badge-info">{{ $quiz->quiz }}</div>
                    </div>
                    <br>
                    <form action="{{ route('quiz.edit', ['id' => $quiz->id]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <input name="name" class="form-control" value="{{ $quiz->quiz }}" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       id="datetimepicker"
                                       name="expiry_date"
                                       value="{{ $quiz->expiry_date }}"
                                       placeholder="expiry_date"
                                />
                            </div>
                        </div>
                        <br>
                       <p> <button type="submit" class="btn btn-warning">Update Quiz</button></p>
                    </form>
                    <hr>
                    <h4 class="well well-sm">Create Question</h4>
                    <a class="btn btn-success" role="button" href="{{ route('question.create', ['id' => $quiz->id]) }}">
                        Add Question
                    </a>
                    <hr>
                    @if($errors->any())
                        <div  class="alert alert-warning"><i class="fa fa-adjust fa-2x"></i><h3 style="color:#000000;font-family: Aparajita">{{$errors->first()}}</h3> </div>
                    @endif
                    <div class="row">
                        <div class="col-md-2">
                    <a href="{{route('publish.result',['id'=>$quiz->id])}}" class="btn btn-info">Publish</a></div>
                        <div class="col-md-6"><h4><p class="alert-info">
                        After entering Answers, Don't forget to click publish button.</p></h4>
                        </div>
                        <div class="col-md-4"></div>
                    </div>

                     <!-- modal -->


                    <!-- Modal -->
{{--                  @include('admin.pages.quiz.modal-answer')--}}
                    <!-- End modal -->



                    <div class="panel-body edit-quiz-container ">



                        <h4 class="well well-sm" >Edit Questions</h4>
                            @foreach($quiz->questions()->get() as $question)
                                <div class="edit-questions-list">
                                    <div class="card">
                                        <h4 class="text-dark alert alert-success" style="display: flex;margin-top: 10px; align-items: center; justify-content: space-between">
                                            <span><i class="fa fa-arrow-right "></i> &nbsp;  {{$question->question}}</span>
                                          <span style="display: flex;">
                                                <a  style="margin :0 4px;"  class="btn btn-sm btn-warning fa fa-pencil text-white"
                                                         role="button" title="Edit Question"
                                                         href="{{ route('question.editForm', ['quiz' => $quiz->id, 'question' => $question->id]) }}">
                                                 </a>
                                            <form method="POST" action="{{ route('question.delete', ['quiz' => $quiz->id, 'question' => $question->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn  btn-sm btn-danger fa fa-trash text-danger"  title="Delete Question" type="submit"></button>
                                            </form>
                                          </span>
                                        </h4>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
</div>
    </div>

@endsection

<script>

    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })

</script>