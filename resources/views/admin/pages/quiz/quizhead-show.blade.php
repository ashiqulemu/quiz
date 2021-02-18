@extends('admin.admin')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage Quiz Head
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                        <thead>
                        <tr>
                            <th>First Head </th>
                            <th>Second Head </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qhead as $quiz)
                            <tr>
                                <td>{{$quiz->first_header}}</td>
                                <td>{{$quiz->second_header}}</td>
                                <td>
                                    <div>
                                        <a href="{{url('/admin/quizhead/'.$quiz->id).'/edit'}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  href="#" @click.prevent="deleteMe('{{'/admin/quizhead/'.$quiz->id}}')" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>




            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection