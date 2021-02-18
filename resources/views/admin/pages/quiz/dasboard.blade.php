@extends('admin.admin')

@section('content')


    <div id="page-wrapper">

        <div class="row">
            <div class="col-md-12 ">
                <h4 class="well well-sm">Create Quiz</h4>
                <div class="panel">
                    <div class="dashboard-container">
                        <form action="{{ route('quiz.create') }}" method="POST" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div >
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="quiz" placeholder="New Quiz Name" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control"
                                               id="datetimepicker"
                                               name="expiry_date"
                                               placeholder="expiry_date"
                                        />

                                    </div>
                                    <br><br>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <select class="js-example-basic-multiple form-control"
                                            name="quiz_type" id="select1">
                                        <option value="">Select Quiz Type</option>
                                        <option value="First"
                                        @if (old('quiz_type') == 'First') {{ 'selected' }} @endif>First</option>

                                        <option value="Next"
                                        @if (old('quiz_type') == 'Next') {{ 'selected' }} @endif>Next</option>

                                    </select>
                                </div>
                                <div class="col-md-6">

                                </div>

                            </div>
                            <br>
                                    <button type="submit" class="btn btn-primary  btn-sm btn-success">Create</button>




                        </form>
                    </div>
                </div>

                <div class="panel">
                    <h4 class="well well-sm">Quiz List</h4>

                        @if(isset($first) && isset($next))

                            <div class="header">
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action">
                                        <span>{{ $first->quiz }}</span>
                                        <div style=" display: flex;    justify-content: center; margin-top: -5px;   align-items: center;"
                                             class="pull-right">
                                            <a class="btn btn-warning btn-sm" style="margin-right:5px;" role="button"
                                               href="{{ route('quiz.editForm', ['id' => $first->id]) }}">Edit Quiz</a>
                                            <form method="POST"
                                                  action="{{ route('quiz.delete', ['id' => $first->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action">
                                        <span>{{ $next->quiz }}</span>
                                        <div style=" display: flex;    justify-content: center; margin-top: -5px;   align-items: center;"
                                             class="pull-right">
                                            <a class="btn btn-warning btn-sm" style="margin-right:5px;" role="button"
                                               href="{{ route('quiz.editForm', ['id' => $next->id]) }}">Edit Quiz</a>
                                            <form method="POST"
                                                  action="{{ route('quiz.delete', ['id' => $next->id]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    @endif
                </div>
                <!---------------->
                <div class="panel ">
                    <h4 class="well well-sm">Winner Prize</h4>

                    <div class="new-quiz-container">
                        <form method="POST" action="{{route('create.prize')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="number" name="score" placeholder="Enter winning score"
                                           class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="prize" class="form-control" placeholder="Enter PRIZE"/>

                                </div>
                                <div class="col-md-4  display: flex;">
                                    <button type="submit" class="btn btn-sm btn-success">Create</button>
                                </div>
                            </div>



                        </form>
                    </div>
                    <br><br>


                    <div class="dashboard-container">

                        @foreach($record as $key =>$rec)


                            <div class="row">

                                <form method="POST" action="{{ route('prize.prizeupdate', ['prize' => $record[$key]->id]) }}">
                                    {{ csrf_field() }}
                                <div class="col-md-4">
                                    <div class="form-group" style=" display: flex;">
                                        <label>Score: </label>
                                        <input type="number" value="{{$record[$key]->score}}" name="score"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style=" display: flex;">
                                        <label>Prize: </label>
                                        <input type="number" value="{{$record[$key]->gift}}" name="prize"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2" style=" display: flex;">


                                        <button class="btn btn-warning btn-sm" style="margin-right:5px;" role="button"  type="submit"> Update quiz</button>


                                </div>
                                </form>
                                <div class="col-md-2">
                                    <form method="POST" action="{{ route('prize.delete', ['prize' => $record[$key]->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn  btn-sm btn-danger text-danger"  title="Delete Prize" type="submit">Delete Prize</button>
                                    </form>
                                </div>
                            </div>
                            <br>


                        @endforeach

                    </div>


                </div>



            </div>
        </div>
    </div>

@endsection
@section('scripts')


    @endsection