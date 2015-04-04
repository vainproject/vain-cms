@extends('app')

@section('title')
    @lang('user::profile.title.edit')
@stop

@section('content')
    <div class="container">
        {!! Form::model($user, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('user.profile', [ $user->id ]),
            'data-remote-error-message' => trans('user::profile.save.error'),
            'route' => 'user.profile.update',
            'method' => 'PUT']) !!}

        @include('user::profile.form')

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

        {!! Form::close() !!}
    </div>
@stop