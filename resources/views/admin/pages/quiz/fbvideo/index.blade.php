@extends('admin.admin')

@section('content')

<div id="page-wrapper">
    <br>
    <div class="row site-forms">
        <form method="post" action="{{url('/admin/savefb-video')}}" enctype="multipart/form-data">
            @csrf
            <div class="">
                <div class="form-box-header">
                    + Add Video
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="">Youtube Url</label>
                        <input
                                class="form-control"
                                name="name"
                                type="text"
                                placeholder="enter Youtube Url"
                        >
                        {{--<label for="">video</label>--}}
                        {{--<input--}}
                                {{--class="form-control"--}}
                                {{--name="video"--}}
                                {{--type="file"--}}
                                {{--placeholder="Upload your video"--}}
                        {{-->--}}

                        @if ($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
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