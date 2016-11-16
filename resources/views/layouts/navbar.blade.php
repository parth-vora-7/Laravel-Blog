<?php $darkbg = NULL; $isHome = TRUE; ?>
@if(Route::currentRouteName() !== 'home')
<?php 
$darkbg = 'dark-bg'; 
$isHome = FALSE;
?>
@endif

<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top {{ $darkbg }}">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="{{ ($isHome) ? '#page-top' : URL::route('home') }}">Start Bootstrap</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="page-scroll" href="{{ ($isHome) ? '#services' : URL::route('services') }}">Services</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ ($isHome) ? '#page-top' : URL::route('portfolio') }}">Portfolio</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ ($isHome) ? '#about' : URL::route('about') }}">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ ($isHome) ? '#team' : URL::route('team') }}">Team</a>
                </li>
                <li>
                    <a class="page-scroll" href="{{ ($isHome) ? '#contact' : URL::route('contact') }}">Contact</a>
                </li>
                @if(auth::user())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blogs<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ URL::route('blog.index') }}">All blogs</a></li>
                      <li><a href="{{ URL::route('user.blog', auth::user()) }}">My blogs</a></li>
                      <li><a href="{{ URL::route('blog.create') }}">Add new blog</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::guest())
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
                      @if(Auth::user()->password)
                      <li><a href="{{ URL::route('password.change', auth::user()->id) }}">Change password</a></li>
                      @else
                      <li><a href="{{ URL::route('password.set', auth::user()) }}">Set password</a></li>
                      @endif
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
</div>
</nav>