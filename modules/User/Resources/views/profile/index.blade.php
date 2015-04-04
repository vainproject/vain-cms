@extends('app')

@section('title')
    @lang('user::profile.title.index', ['name' => $user->name])
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-circle">
            </div>
            <div class="col-xs-9">
                <strong>{{ $user->name }}</strong><br>
                {{ $user->email }}<br>
                {{ $user->birthday_at }}<br>
                {{ $user->gender }}<br>
                {{ $user->city }}<br>
                {{ $user->profession }}<br>
                {{ $user->hobbies }}<br>
                {{ $user->homepage }}<br>

                {{ $user->skype }}<br>
                {{ $user->facebook }}<br>
                {{ $user->twitter }}<br>

                {{ $user->main_character }}<br>
                {{ $user->main_guild }}<br>

                {{ $user->favorite_race }}<br>
                {{ $user->favorite_class }}<br>
                {{ $user->favorite_spec }}<br>
                {{ $user->favorite_instance }}<br>
                {{ $user->favorite_battleground }}<br>
                <a href="{{ route('user.profile.edit') }}">Edit profile...</a>
            </div>
        </div>
    </div>
@stop