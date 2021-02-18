
@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <br>
        @if ($errors->has('message'))
            <div class="error">{{ $errors->first('message') }}</div>
        @endif
        <div class="row site-forms">
            <form method="post" action="{{url('admin/quizhead')}}">
                @csrf
                <div class="">
                    <div class="form-box-header">
                        + Add Cms
                    </div>
                </div>



                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">First Head</label>
                        <textarea class="form-control"
                                  name="first_header"
                                  id="description">
                                {{old('content')}}
                            </textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Second Head</label>
                        <textarea class="form-control"
                                  name="second_header"
                                  id="description">
                                {{old('content')}}
                            </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary ml-2" type="submit">submit</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    <!-- /#page-wrapper -->

@endsection