<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="{{url('/admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
          
          
        
          
            
           
                <!-- /.nav-second-level -->
          
            
            <li>
                <a href="{{url('/admin/quiz')}}"><i class="fa fa-book"></i>Quiz<span class="fa arrow"></span></a>
                {{--<ul class="nav nav-second-level">--}}
                    {{--<li>--}}
                        {{--<a href="{{url('/admin/cms/create')}}">Add CMS</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{url('/admin/cms')}}">Manage CMS</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                <!-- /.nav-second-level -->
            </li>

     
            <li>
                <a href="#"><i class="fa fa-certificate"></i>Pending Wallet<p class="label label-pill label-danger ml-4">{{\App\withdrawl::all()->where('status','Pending')->count()}}</p><span class="fa arrow"> </span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{url('/admin/withdraw-request')}}">Request</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->

