@extends('admin.admin')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <p class="pageTitle">
                    <i class="fa fa-cogs"></i>  Manage Request
                </p>
            </div>
            <div class="col-md-12 ">
                <div class="overflow">
                    <table class="table table-striped  table-bordered table-hover" id="manageTable">
                                <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>E-mail</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Request Date</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                    @foreach($history as $key=>$show)


         <tr>

        <td>{{$show->id}}</td>
        <td>{{$show->user_name}}</td>
        <td>{{$show->email}}</td>
        <td>{{$show->amount}} $</td>
        @if($show->status=="Pending")
            <td><h5 style="color:red">{{$show->status}}..</h5></td>
        @else
            <td><button class="btn btn-primary">{{$show->status }}</button></td>
        @endif
        <td>{{date('d-m-Y', strtotime($show->created_at))}}</td>

             <td><a href="{{url('/admin/payment/'.$show->id)}}" class="btn btn-success button-global">Pay</a></td>
    </tr>
    @endforeach

    </tbody>

    </table>
    </div>
            </div>
        </div>
    </div>
    @endsection