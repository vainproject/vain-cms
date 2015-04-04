<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                    @lang('blog::admin.posts.action.save')
                </button>
                <a class="btn btn-default" href="{{ route('blog.admin.posts.index') }}">
                    <i class="fa fa-ban fa-lg"></i>&nbsp;
                    @lang('blog::admin.posts.action.abort')
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
                <h3 class="box-title">@lang('blog::admin.posts.section.general')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('slug', trans('blog::admin.posts.field.slug'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('published_at', trans('blog::admin.posts.field.published_at'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::date('published_at', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('concealed_at', trans('blog::admin.posts.field.concealed_at'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::date('concealed_at', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

</div><!-- /.row -->

