@extends('site.app')
@section('title-meta')
    <title>Firebidder user loged </title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')
    @include('.site.login.login-partitial.nav')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Firebidders</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.components.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">Quiz Result</h4>
                        @if($result->count() <1)
                            <p class="glyphicon-font">You Have not taken quizzes in recent past</p>
                        @else

                        <table class="table-striped table">
                            <tr>
                                <td align="center">Quiz Name</td>
                                <td align="center">Correct Answer</td>
                                <td align="center">Prize/Point</td>
                                <td align="center">Quiz-Taken Date</td>
                            </tr>
                                <?php $i=0; ?>
                                @foreach($result as $res)
                                @if($i<=3)
                            <tr>

                                <td align="center"> {{$res->quiz}}</td>
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
                </div>
            </div>

        </div>
        </div>
    </section>
    @component('site.login.user.components.user-sub-footer') @endcomponent
@endsection
