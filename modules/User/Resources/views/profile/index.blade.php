@extends('app')

@section('title')
    @lang('user::profile.title.index', ['name' => $user->name])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <img src="{{ $user->getAvatar() }}" alt="Voydz" class="img-circle">
            </div>
            <div class="col-xs-9">
                <strong>{{ $user->name }}</strong><br>
                {{ $user->email }}<br>
                <a href="{{ route('user.profile.edit') }}">Edit profile...</a>
            </div>
        </div>
    </div>
@stop