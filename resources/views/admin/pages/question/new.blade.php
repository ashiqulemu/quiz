@extends('admin.admin')

@section('content')


    <div id="page-wrapper">
        <!-- /.row -->
        <div class="row reportPanels" style="padding-top: 30px">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h4 class="panel">

                    <h4 class="well well-sm"> Quiz Name :{{ $quiz->quiz }}</h4></h4>

                    <div class="new-question-container">
                        <form method="POST" action="{{ route('question.store', ['quiz' => $quiz->id]) }}">
                            {{ csrf_field()}}

                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" placeholder="Question" name="question" required>
                            </div>

                            <div class="form-group">
                                <label class="text-success" for="correct answer">Answer</label>
                                <input type="text" class="form-control" placeholder="Correct Answer" name="answer"
                                      >
                            </div>

                            <div class="form-group">
                                <label class="text-danger" for="option1">option 1</label>
                                <input type="text" class="form-control" placeholder="First option" name="option1"
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="text-danger" for="wrong answer">Option 2</label>
                                <input type="text" class="form-control" placeholder="Second option" name="option2"
                                       required>
                            </div>



                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


            <div class="col-md-2"></div>


</div>
    </div>
    </div>
@endsection