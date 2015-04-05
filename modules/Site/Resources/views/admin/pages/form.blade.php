<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                    @lang('site::admin.action.save')
                </button>
                <a class="btn btn-default" href="{{ route('site.admin.sites.index') }}">
                    <i class="fa fa-ban fa-lg"></i>&nbsp;
                    @lang('site::admin.action.abort')
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
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('slug', trans('site::admin.slug'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('user_id', trans('site::admin.creator'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('user_id', $users, null, [ 'class' => 'form-control', 'data-select' ]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('role', trans('site::admin.role'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('role', $roles, null, [ 'class' => 'form-control', 'data-select' ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('published_at', trans('site::admin.published_at'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::date('published_at', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('concealed_at', trans('site::admin.concealed_at'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::date('concealed_at', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div role="tabpanel" class="nav-tabs-custom">
    <ul class="nav nav-tabs" role="tablist" data-auto-active>
        @foreach($locales as $locale => $name)
            <li role="presentation">
                <a href="#{{ $locale }}" aria-controls="{{ $locale }}" role="tab" data-toggle="tab">{{ $name }}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" data-auto-active>
        @foreach($locales as $locale => $name)
            <div role="tabpanel" class="tab-pane" id="{{ $locale }}">
                @include('site::admin.pages.content', ['locale' => $locale])
            </div>
        @endforeach
    </div>
</div>

@section('scripts')
    <script src="/vendor/ckeditor/ckeditor.js"></script>
@stop