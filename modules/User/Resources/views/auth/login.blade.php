@extends('app')

@section('title')
    @lang('user::auth.title.login')
@stop

@section('headline')
    <h1>@lang('user::auth.title.login')</h1>
    <h2>{{ Inspiring::quote() }}</h2>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default v-margin-lg">
                    <div class="panel-heading">@lang('user::auth.action.login')</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="/auth/login">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="col-md-4 control-label">@lang('user::profile.field.email')</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">@lang('user::profile.field.password')</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> @lang('user::auth.remember_me')
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-default">
                                        @lang('user::auth.action.login')
                                    </button>

                                    <a class="small" href="/password/email">@lang('user::auth.forgot_password')</a>
                                </div>
                            </div>

                            @if (config('services.socialite.enable', false))
                                {{-- socialite --}}
                                <div class="col-md-6 col-md-offset-4">
                                    <hr />
                                    <ul class="social-links pull-right no-spacing">
                                        <li><a href="{{ route('social.redirect', ['provider' => 'twitter']) }}"><i class="icon-twitter"></i></a></li>
                                        <li><a href="{{ route('social.redirect', ['provider' => 'facebook']) }}"><i class="icon-facebook"></i></a></li>
                                        <li><a href="{{ route('social.redirect', ['provider' => 'google']) }}"><i class="icon-googleplus"></i></a></li>
                                    </ul>
                                    <span class="text-muted">Or login using:</span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
