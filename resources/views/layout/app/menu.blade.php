<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>Vain</b> App</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {!! (new \Vain\Presenters\Menu\VainPresenter())->render($menu) !!}
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/auth/login">@lang('user::auth.action.login')</a></li>
                    <li><a href="/auth/register">@lang('user::auth.action.register')</a></li>
                @else
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <img src="{{ Auth::user()->getAvatar() }}" /> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route( 'user.profile', [ Auth::user()->id ] ) }}">@lang('user::profile.title.mine')</a></li>
                            <li><a href="/auth/logout">@lang('user::auth.action.logout')</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>