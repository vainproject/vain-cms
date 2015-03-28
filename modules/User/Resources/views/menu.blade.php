<ul class="nav navbar-nav navbar-right">
    @if ($guest)
        <li><a href="/auth/login">@lang('user::auth.action.login')</a></li>
        <li><a href="/auth/register">@lang('user::auth.action.register')</a></li>
    @else
        <li class="dropdown dropdown-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $user->name }} <img src="{{ $user->getAvatar() }}" /> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route( 'user.profile', [ $user->id ] ) }}">@lang('user::profile.title.mine')</a></li>
                <li><a href="/auth/logout">@lang('user::auth.action.logout')</a></li>
            </ul>
        </li>
    @endif
</ul>