@extends('admin.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage Video
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>Video Name</th>
                            <th>Video File</th>
                            <th>Status</th>
                            <th> Upload Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($videos as $key=>$video)


                            <tr>

                                <td>{{$videos[$key]->id}}</td>
                                <td>{{$videos[$key]->name}}</td>
                                <td>{{$videos[$key]->video}}</td>
                                @if($videos[$key]->status=="Publish")
                                <td><p href="" class="btn btn-success">{{$videos[$key]->status}}</p> </td>
                                @else
                                    <td><p class="btn btn-danger">{{$videos[$key]->status}}</p> </td>
                                @endif
                                <td>{{$videos[$key]->created_at}} </td>
                                <td>
                                    @if($videos[$key]->status =="Unpublish")
                                    <a href="{{url('/admin/publish/'.$videos[$key]->id)}}" class="btn btn-success badge">Publish</a>
                                    @endif
                                    <a  href="#" @click.prevent="deleteMe('{{'/admin/video-delete/'.$videos[$key]->id}}')" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection