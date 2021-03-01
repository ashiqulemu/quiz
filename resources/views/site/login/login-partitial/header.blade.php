<section class="loged-header" >
    <div class="container">
        <div class="header">
            <div>
                <div class="brand">
                    <a href="#">
                        <img src="/images/logo.png" class="img-fluid d-block">
                    </a>
                </div>
            </div>
            <div>
                <ul>
                    {{--<li><a href="/how-it-works">How it works</a></li>--}}
                    <li>
                        <i class="fa fa-user"></i>
                        <a href="{{url('/quiz-user-details/my-information')}}">{{auth()->user()->username}}</a>
                    </li>
                    
                    <li>You have {{auth()->user()->credit_balance}} coins</li>
                    <li>
                        <a href="{{url('/credit-product')}}" class="btn btn-warning text-dark text-capitalize">top up coins</a>
                    </li>
                </ul>
            </div>
            @if(auth()->user())
                <div>
                    <a class="btn btn-outline-primary" href="{{ url('admin/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            @endif
        </div>
    </div>
</section>