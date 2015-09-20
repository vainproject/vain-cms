<div id="main-nav">
    <div class="container">
        <div class="nav-header">
            <a class="nav-brand" href="{{ route('index') }}"></i>Vain.</a>
            <a class="menu-link nav-icon" href="#"><i class="icon-menu2"></i></a>
            @if (Auth::guest())
                <a class="btn btn-blog outline-white pull-right" href="/auth/login">@lang('user::auth.action.login')</a>
            @else
                <a class="btn btn-blog outline-white pull-right" href="/auth/logout">@lang('user::auth.action.logout')</a>
                <a class="btn btn-blog outline-white pull-right" href="{{ route( 'user.profile', [ Auth::user()->id ] ) }}">@lang('user::profile.title.mine')</a>
            @endif
        </div>
    </div>
</div>

@section('header')
    <section id="hero" class="light-typo">
        <div id="cover-image" class="animated fadeIn"></div>
        <div class="container welcome-content">
            <div class="middle-text">
                @yield('headline')
            </div>
        </div>
    </section>
@show