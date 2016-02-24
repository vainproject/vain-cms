<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-floppy-o fa-lg"></i>&nbsp;
                    @lang('gallery::admin.category.action.save')
                </button>
                <a class="btn btn-default" href="{{ route('gallery.admin.category.index') }}">
                    <i class="fa fa-ban fa-lg"></i>&nbsp;
                    @lang('gallery::admin.category.action.abort')
                </a>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>@lang('app.errors.whops')</strong> @lang('app.errors.input')<br><br>
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
                <h3 class="box-title">@lang('gallery::admin.category.section.general')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('slug', trans('gallery::admin.category.field.slug'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>

</div><!-- /.row -->

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
                @include('gallery::admin.category.content', ['locale' => $locale])
            </div>
        @endforeach
    </div>
</div>