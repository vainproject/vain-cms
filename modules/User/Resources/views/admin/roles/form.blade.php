<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <button class="btn btn-success" type="submit">
                    @lang('user::role.action.save')
                </button>
                <a class="btn btn-default" href="{{ route('user.admin.roles.index') }}">
                    @lang('user::role.action.abort')
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('user::role.section.general')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', trans('user::role.alias'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('display_name', trans('user::role.name'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('description', trans('user::role.description'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('user::role.section.permission')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                     <div class="col-sm-12">
                        {!! Form::select('permissions[]', $permissions, $role->perms()->lists('id'), ['multiple', 'class' => 'form-control', 'size' => count($permissions)]) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>