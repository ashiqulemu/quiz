@extends('admin.admin')

@section('content')


    <div id="page-wrapper">
        <!-- /.row -->
        <div class="row reportPanels" style="padding-top: 30px">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="panel">
                    <h4 class="well well-sm">Edit Question</h4>

                        <form action="{{ route('question.edit', ['quiz' => $quiz->id, 'question' => $question->id]) }}"
                              method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" name="question"
                                       value="{{ $question->question }}" required>
                            </div>


                                    <div class="form-group">
                                        <label class="text-success" for="correct answer"> Answer</label>
                                        <input type="text" class="form-control" name="answer"
                                               value="{{$question->answer}}" >
                                    </div>

                                    <div class="form-group">
                                        <label class="text-danger" for="wrong answer">Option1 </label>
                                        <input type="text" class="form-control" name="option1"
                                               value="{{$question->option1}}" required>
                                    </div>
                            <div class="form-group">
                                <label class="text-danger" for="wrong answer">Option2 </label>
                                <input type="text" class="form-control" name="option2"
                                       value="{{$question->option2}}" required>
                            </div>

                            <button class="btn btn-primary">Update Question</button>
                        </form>

                </div>
            </div>
            <div class="col-md-2"></div>

        </div>
    </div>

@endsection
