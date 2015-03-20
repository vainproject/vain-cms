<a href="{{ route( 'index' ) }}" class="logo"><b>Vain</b> Backend</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user()->getAvatar() }}" class="user-image" alt="User Image"/>
                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{ Auth::user()->getAvatar() }}" class="img-circle" alt="User Image" />
                        <p>
                            {{ Auth::user()->name }}
                            <small>@lang('user::auth.member_since', [ 'date' => Auth::user()->created_at->format('F Y') ])</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ route( 'user.profile', [ Auth::user()->id ] ) }}" class="btn btn-default btn-flat">@lang('user::profile.title.mine')</a>
                        </div>
                        <div class="pull-right">
                            <a href="/auth/logout" class="btn btn-default btn-flat">@lang('user::auth.action.logout')</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>