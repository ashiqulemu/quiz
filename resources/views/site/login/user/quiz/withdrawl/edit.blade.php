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
                    @if(isset($message))
                        <h5 class="ml-5" style="color:orangered">{{$message}}</h5>
                    @else
                    <div class="userDetailsArea">
                        <h4 class="text-capitalize pb-3">Edit Request Form</h4>
                        <h6>You have {{auth()->user()->credit_balance}} coins equivalent to $ {{auth()->user()->credit_balance/100}}(USD)</h6>
                        <form method="post" action="{{url('/update-request/'.$edit[0]->id)}}">
                            @csrf
                            <table class="editSettingsTable">
                                <tr>
                                    <td>Please Enter Paypal Email<span class="mandatory">*</span></td>
                                    <td>
                                        <input type="email"
                                               required
                                               name="email"
                                                value="{{$edit[0]->email}}">
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Withdrwal amount in $(USD) <span class="mandatory">*</span> </td>
                                    <td>
                                        <input type="number"
                                               required
                                               name="amount"
                                                value="{{$edit[0]->amount}}">
                                        @if ($errors->has('message'))
                                            <div class="error">{{ $errors->first('message') }}</div>
                                        @endif
                                    </td>

                                </tr>

                                <tr>

                                <tr> <td><button class="button-global">Update</button></td></tr>
                            </table>
                        </form>

                    </div>
                    @endif
                </div>

            </div>

        </div>

    </section>
    {{--    @component('site.login.user.components.user-sub-footer') @endcomponent--}}
@endsection
