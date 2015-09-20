@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<input type="hidden" name="_token" value="{{ csrf_token() }}">
<h3>@lang('user::profile.section.general')</h3>
<div class="form-group">
    {!! Form::label('name', trans('user::profile.field.name'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('name', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', trans('user::profile.field.email'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::email('email', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('gender', trans('user::profile.field.gender'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::select('gender', $genders, null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('locale', trans('user::profile.field.locale'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::select('locale', $locales, null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('birthday_at', trans('user::profile.field.birthday_at'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::date('birthday_at', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('city', trans('user::profile.field.city'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('city', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::label('about', trans('user::profile.field.about'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::textarea('about', null, [ 'class' => 'form-control', 'data-expand', 'rows' => 1, 'data-expand-rows-max' => 6 ]) !!}
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::label('profession', trans('user::profile.field.profession'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('profession', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('hobbies', trans('user::profile.field.hobbies'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('hobbies', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('homepage', trans('user::profile.field.homepage'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('homepage', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::label('skype', trans('user::profile.field.skype'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('skype', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('facebook', trans('user::profile.field.facebook'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('facebook', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('twitter', trans('user::profile.field.twitter'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('twitter', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<hr>
<h3>@lang('user::profile.section.game')</h3>
<div class="form-group">
    {!! Form::label('main_character', trans('user::profile.field.main_character'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('main_character', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('main_guild', trans('user::profile.field.main_guild'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('main_guild', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<hr>
<div class="form-group">
    {!! Form::label('favorite_race', trans('user::profile.field.favorite_race'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('favorite_race', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('favorite_class', trans('user::profile.field.favorite_class'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('favorite_class', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('favorite_spec', trans('user::profile.field.favorite_spec'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('favorite_spec', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('favorite_instance', trans('user::profile.field.favorite_instance'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('favorite_instance', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('favorite_battleground', trans('user::profile.field.favorite_battleground'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::text('favorite_battleground', null, [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<hr>
<h3>@lang('user::profile.section.password')</h3>
<div class="form-group">
    {!! Form::label('password', trans('user::profile.field.password'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::password('password', [ 'class' => 'form-control' ]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', trans('user::profile.field.password_confirmation'), [ 'class' => 'col-sm-2 control-label' ]) !!}
    <div class="col-sm-10">
        {!! Form::password('password_confirmation', [ 'class' => 'form-control' ]) !!}
    </div>
</div>