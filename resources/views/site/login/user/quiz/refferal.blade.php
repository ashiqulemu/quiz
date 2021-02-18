@extends('site.app')
@section('title-meta')
    <title>Galaxy User Loggedin </title>
@endsection

@section('content')
    @include('.site.login.login-partitial.header')
    @include('site.login.login-partitial.quiz.quiz-button')

    <section class="myFirebidder">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Referral</h2>
                    <hr>
                </div>
                <div class="col-lg-3">
                    @component('site.login.user.quiz.leftBar') @endcomponent
                </div>
                <div class="col-lg-9 p-0">

                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">My Referrals</h4>
                        <table class="table-striped table">
                            <tr>
                                <td>Referral url</td>
                                <td>http://www.galaxy.games/?ref=20100{{auth()->user()->id}}</td>
                            </tr>
                            <tr>
                                <td> Referred User</td>
                                <td>{{$referCount}}</td>
                            </tr>
                        </table>
                        <p>Click <a href="{{url('/quiz-user-details/referral-friend')}}">here</a> to refer a friend now</p>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
{{--    @component('site.login.user.components.user-sub-footer') @endcomponent--}}
@endsection
