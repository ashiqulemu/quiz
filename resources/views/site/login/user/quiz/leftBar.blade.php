<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"   data-parent="#accordion" href="#collapse0" aria-expanded="true">My
                    Information</a>
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="inner">
                    <a id='my_information' href="{{url('/quiz-user-details/my-information')}}" >Personal Information</a>
                    <a id='edit_setting' href="{{url('/quiz-user-details/qsettings')}}">Edit Information</a>
                    <a id='changePassword' href="{{url('/quiz-user-details/change-password')}}">Change Password</a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">My Referral</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="inner">
                    <a id="addReferral" href="{{url('/quiz-user-details/referral')}}">Referral info</a>
                    <a id="referFriend" href="{{url('/quiz-user-details/referral-friend')}}">Refer friend</a>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading">--}}
{{--            <h4 class="panel-title">--}}
{{--                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">My Inbox</a>--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div id="collapse3" class="panel-collapse collapse">--}}
{{--            <div class="panel-body">--}}
{{--                <div class="inner">--}}
{{--                    <a href="#">My Messages(0)</a>--}}
{{--                    <a href="#">My Notifications(0)</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="panel panel-default">--}}
{{--        <div class="panel-heading">--}}
{{--            <h4 class="panel-title">--}}
{{--                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">My--}}
{{--                    Referrals</a>--}}
{{--            </h4>--}}
{{--        </div>--}}
{{--        <div id="collapse4" class="panel-collapse collapse">--}}
{{--            <div class="panel-body">--}}
{{--                <div class="inner">--}}
{{--                    <a href="{{url('/user-details/refferal')}}">Referrals</a>--}}
{{--                    <a href="#">Cash Rewards</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Quiz</a>
            </h4>
        </div>
        <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="inner">
                    <a id="allOrder" href="{{url('/quiz-edit')}}">Edit Quiz</a>
                    <a id="allOrder" href="{{url('/quiz-result')}}">Quiz Result</a>
                </div>
            </div>
        </div>

    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Withdraw</a>
            </h4>
        </div>
        <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="inner">
                    <a id="allOrder" href="{{url('/request')}}"> Withdraw Request</a>
                    <a id="allOrder" href="{{url('/edit-request')}}">Edit Request</a>
                    <a id="allOrder" href="{{url('/withdrawl-history')}}">Withdraw History</a>
                </div>
            </div>

        </div>
    </div>

</div>

