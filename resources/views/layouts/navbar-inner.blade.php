<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top dark-bg">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="    #bs-example-navbar-collapse-1   ">
             <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
         </button>
         <a class="navbar-brand page-scroll" href="{{ URL::to('/') }}">Start Bootstrap</a>
     </div>

     <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="" lass="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li class="hidden">
                <a href="#page-top"></a>
            </li>
            <li>
                <a href="{{ URL::route('services') }}">Services</a>
            </li>
            <li>
                <a href="{{ URL::route('portfolio') }}">Portfolio</a>
            </li>
            <li>
                <a href="{{ URL::route('about') }}">About</a>
            </li>
            <li>
                <a href="{{ URL::route('team') }}">Team</a>
            </li>
            <li>
                <a href="{{ URL::route('contact') }}">Contact</a>
            </li>
            @if(auth::guest())
                    <li>
                        <a href="{{ url('login') }}">Login</a>
                    </li>
                    <li>
                        <a href="{{ url('register') }}">Signup</a>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><small>Welcome</small>, {{ auth::user()->name }}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ URL::route('profile.edit', auth::user()->id) }}">Edit profile</a></li>
                          <li><a href="{{ URL::route('password.change') }}">Change password</a></li>
                          <li>
                              <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                              <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container-fluid -->
</nav>