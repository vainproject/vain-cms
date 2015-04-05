<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                    @lang('user::role.action.save')
                </button>
                <a class="btn btn-default" href="{{ route('user.admin.roles.index') }}">
                    <i class="fa fa-ban fa-lg"></i>&nbsp;
                    @lang('user::role.action.abort')
                </a>
            </div>
        </div>
    </div>
</div>

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

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('user::role.section.general')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('name', trans('user::role.field.alias'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('display_name', trans('user::role.field.name'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('color', trans('user::role.field.color'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        <select name="color" class="form-control" data-select>
                            @foreach($colors as $value)
                                <option @if(isset($role) && $role->color == $value) selected @endif data-content="<span class='label label-role label-expand role-{{ $value }}'>&nbsp;</span>" value="{{ $value }}"></option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('order', trans('user::role.field.order'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('order', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('description', trans('user::role.field.description'), ['class' => 'col-sm-3 control-label']) !!}
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
                        {!! Form::select('permissions[]', $permissions, empty($role) ?: $role->perms()->lists('id'), ['multiple', 'class' => 'form-control', 'size' => count($permissions)]) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>