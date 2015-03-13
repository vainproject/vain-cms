@extends('app')

@section('title')
    @lang('user::profile.title.edit')
@stop

@section('content')
    <div class="container">
        <form class="form-horizontal" method="post" target="{{ route('user.profile.save') }}">
            <h3>@lang('user::profile.section.general')</h3>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">@lang('user::profile.field.name')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">@lang('user::profile.field.email')</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="{{ $user->email }}">
                </div>
            </div>
            <hr>
            <h3>@lang('user::profile.section.password')</h3>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">@lang('user::profile.field.password')</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label">@lang('user::profile.field.password_confirmation')</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="pull-right">
                    <button type="submit" class="btn btn-success">
                        @lang('user::profile.action.save')
                    </button>
                    <a class="btn btn-default" href="{{ route('user.profile', ['id' => $user->id ]) }}">
                        @lang('user::profile.action.abort')
                    </a>
                </div>
            </div>
        </form>
    </div>
@stop