@extends('site.app')
@section('title-meta')
    <title>Galaxy User Loggedin </title>
@endsection

@section('content')
    @include('.site.login.login-partitial.quiz.header')
    @include('site.login.login-partitial.quiz.quiz-button')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Withdrawl</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.quiz.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">Withdrawl History</h4>
                        <div class="overflow">
                            <table class="table table-striped  table-bordered table-hover" id="manageTable">
                                <thead>
                                <tr>

                                    <th>Withdrawl ID</th>
                                    <th>User Name</th>
                                    <th>E-mail</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Request Date</th>


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
                                            <td><button class="btn btn-danger">{{$show->status}}</button></td>
                                        @else
                                            <td><button class="btn btn-primary">{{$show->status }}</button></td>
                                        @endif
                                        <td>{{date('d-m-Y', strtotime($show->created_at))}}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
    {{--    @component('site.login.user.components.user-sub-footer') @endcomponent--}}
@endsection
