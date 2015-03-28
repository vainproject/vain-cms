@extends('user::admin.index')

@section('title')
    @lang('user::permission.title')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user::profile.title.index', ['name' => $user->name])</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('user::user.save.success'),
            'data-remote-error-message' => trans('user::user.save.error'),
            'method' => 'PUT',
            'route' => ['user.admin.users.edit', $user->id]]) !!}

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @include('user::admin.statistic')

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <button class="btn btn-success" type="submit">
                                @lang('user::profile.action.save')
                            </button>
                            <a class="btn btn-default" href="{{ route('user.admin.users.index') }}">
                                @lang('user::profile.action.abort')
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('user::profile.section.general')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">@lang('user::profile.field.name')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alias" class="col-sm-3 control-label">@lang('user::profile.field.alias')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="alias" name="alias" value="{{ $user->alias }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">@lang('user::profile.field.email')</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-sm-3 control-label">@lang('user::profile.field.gender')</label>
                                <div class="col-sm-9">
                                    {!! Form::select('gender', $genders, $user->gender, [ 'class' => 'form-control' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="locale" class="col-sm-3 control-label">@lang('user::profile.field.locale')</label>
                                <div class="col-sm-9">
                                    {!! Form::select('locale', $locales, $user->locale, [ 'class' => 'form-control' ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birthday_at" class="col-sm-3 control-label">@lang('user::profile.field.birthday_at')</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="birthday_at" name="birthday_at" value="{{ $user->birthday_at }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-sm-3 control-label">@lang('user::profile.field.city')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('user::profile.section.social')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="profession" class="col-sm-3 control-label">@lang('user::profile.field.profession')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="profession" name="profession" value="{{ $user->profession }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="hobbies" class="col-sm-3 control-label">@lang('user::profile.field.hobbies')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="hobbies" name="hobbies" value="{{ $user->hobbies }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="homepage" class="col-sm-3 control-label">@lang('user::profile.field.homepage')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="homepage" name="homepage" value="{{ $user->homepage }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skype" class="col-sm-3 control-label">@lang('user::profile.field.skype')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="skype" name="skype" value="{{ $user->skype }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="facebook" class="col-sm-3 control-label">@lang('user::profile.field.facebook')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $user->facebook }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-sm-3 control-label">@lang('user::profile.field.twitter')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $user->twitter }}">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('user::profile.section.game')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="main_character" class="col-sm-3 control-label">@lang('user::profile.field.main_character')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="main_character" name="main_character" value="{{ $user->main_character }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="main_guild" class="col-sm-3 control-label">@lang('user::profile.field.main_guild')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="main_guild" name="main_guild" value="{{ $user->main_guild }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="favorite_race" class="col-sm-3 control-label">@lang('user::profile.field.favorite_race')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="favorite_race" name="favorite_race" value="{{ $user->favorite_race }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="favorite_class" class="col-sm-3 control-label">@lang('user::profile.field.favorite_class')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="favorite_class" name="favorite_class" value="{{ $user->favorite_class }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="favorite_spec" class="col-sm-3 control-label">@lang('user::profile.field.favorite_spec')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="favorite_spec" name="favorite_spec" value="{{ $user->favorite_spec }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="favorite_instance" class="col-sm-3 control-label">@lang('user::profile.field.favorite_instance')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="favorite_instance" name="favorite_instance" value="{{ $user->favorite_instance }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="favorite_battleground" class="col-sm-3 control-label">@lang('user::profile.field.favorite_battleground')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="favorite_battleground" name="favorite_battleground" value="{{ $user->favorite_battleground }}">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('user::profile.section.password')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">@lang('user::profile.field.password')</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="@lang('user::profile.field.password')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-3 control-label">@lang('user::profile.field.password_confirmation')</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('user::profile.field.password_confirmation')">
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        {{--</form>--}}
        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection