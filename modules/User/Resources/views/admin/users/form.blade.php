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
                    {!! Form::label('name', trans('user::profile.field.name'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('alias', trans('user::profile.field.alias'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('alias', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', trans('user::profile.field.email'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('gender', trans('user::profile.field.gender'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('gender', $genders, null, [ 'class' => 'form-control' ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('locale', trans('user::profile.field.locale'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('locale', $locales, null, [ 'class' => 'form-control' ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('birthday_at', trans('user::profile.field.birthday_at'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::date('birthday_at', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('city', trans('user::profile.field.city'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
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
                    {!! Form::label('profession', trans('user::profile.field.profession'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('profession', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('hobbies', trans('user::profile.field.hobbies'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('hobbies', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('homepage', trans('user::profile.field.homepage'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('homepage', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('skype', trans('user::profile.field.skype'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('skype', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('facebook', trans('user::profile.field.facebook'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('twitter', trans('user::profile.field.twitter'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
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
                    {!! Form::label('main_character', trans('user::profile.field.main_character'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('main_character', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('main_guild', trans('user::profile.field.main_guild'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('main_guild', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('favorite_race', trans('user::profile.field.favorite_race'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('favorite_race', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('favorite_class', trans('user::profile.field.favorite_class'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('favorite_class', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('favorite_spec', trans('user::profile.field.favorite_spec'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('favorite_spec', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('favorite_instance', trans('user::profile.field.favorite_instance'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('favorite_instance', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('favorite_battleground', trans('user::profile.field.favorite_battleground'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('favorite_battleground', null, ['class' => 'form-control']) !!}
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
                    {!! Form::label('password', trans('user::profile.field.password'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', trans('user::profile.field.password_confirmation'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('user::user.section.role')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        {!! Form::select('roles[]', $roles, $user->roles()->lists('id'), ['multiple', 'class' => 'form-control', 'size' => count($roles)]) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>