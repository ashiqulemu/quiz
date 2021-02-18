@extends('site.app')
@section('title-meta')
    <title>Galaxy user loged </title>
@endsection

@section('content')
    @include('.site.login.user.quiz.header')
@include('site.login.login-partitial.quiz.quiz-button')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Galaxy</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.quiz.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                    <div class="userDetailsArea">
                        @if(isset($fexp) )
                        <h4 class="text-capitalize pb-3">{{date('d-M-yy H:m',strtotime($fexp[0]->expiry_date))}} Quiz Result</h4>
                        @endif
                        @if(!isset($first) )
                            <p class="glyphicon-font">No Result found yet for the Recent quiz</p>
                        @else

                            <table class="table-striped table">
                                <tr>
                                    <td align="center">Quiz Name</td>
                                    <td align="center">Quiz Type</td>
                                    <td align="center">Correct Answer</td>
                                    <td align="center">Prize/Point</td>
                                    <td align="center">Quiz-Taken Date</td>
                                </tr>
                                <?php $i=0; ?>
                                @foreach($first as $res)
                                    @if($i<=3)
                                        <tr>

                                            <td align="center"> {{$res->quiz}}</td>
                                            <td align="center"> {{$res->quiz_type}}</td>
                                            <td align="center">{{$res->point}}</td>
                                            <td align="center">{{$res->gift}}</td>
                                            <td align="center">{{date('d-m-Y', strtotime($res->created_at))}}</td>
                                        </tr>
                                    @endif
                                    <?php $i++; ?>
                                @endforeach
                            </table>
                        @endif
                    </div>

                   ================================== *** ===================================
                    <div class="userDetailsArea">
                        @if(isset($fexp) )
                        <h4 class="text-capitalize pb-3">{{date('d-M-yy H:m',strtotime($nexp[0]->expiry_date))}} Quiz Result</h4>
                        @endif
                        @if(!isset($next) )
                            <p class="glyphicon-font">No Result found yet for the Recent quiz</p>
                        @else
                            <table class="table-striped table">
                                <tr>
                                    <td align="center">Quiz Name</td>
                                    <td align="center">Quiz Type</td>
                                    <td align="center">Correct Answer</td>
                                    <td align="center">Prize/Point</td>
                                    <td align="center">Quiz-Taken Date</td>
                                </tr>
                                <?php $i=0; ?>
                                @foreach($next as $resi)
                                    @if($i<=3)
                                        <tr>

                                            <td align="center"> {{$resi->quiz}}</td>
                                            <td align="center"> {{$resi->quiz_type}}</td>
                                            <td align="center">{{$resi->point}}</td>
                                            <td align="center">{{$resi->gift}}</td>
                                            <td align="center">{{date('d-m-Y', strtotime($resi->created_at))}}</td>
                                        </tr>
                                    @endif
                                    <?php $i++; ?>
                                @endforeach
                            </table>
                        @endif
                </div>
            </div>

        </div>
        </div>
    </section>
{{--    @component('site.login.user.components.user-sub-footer') @endcomponent--}}
@endsection
