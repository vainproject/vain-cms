<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ $user->getAvatar() }}" class="user-image" alt="User Image"/>
        <span class="hidden-xs">{{ $user->name }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{ $user->getAvatar() }}" class="img-circle" alt="User Image" />
            <p>
                {{ $user->name }}
                <small>@lang('user::auth.member_since', [ 'date' => $user->created_at->format('F Y') ])</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="{{ route( 'user.profile', [ $user->id ] ) }}" class="btn btn-default btn-flat">@lang('user::profile.title.mine')</a>
            </div>
            <div class="pull-right">
                <a href="/auth/logout" class="btn btn-default btn-flat">@lang('user::auth.action.logout')</a>
            </div>
        </li>
    </ul>
</li>