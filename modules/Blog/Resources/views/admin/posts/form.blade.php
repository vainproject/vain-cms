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

@include('partials.errors', [ 'message' => trans('app.errors.input') ])

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
                    {!! Form::label('slug', trans('blog::admin.posts.field.author'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('user_id', isset($post) ? $post->user->name : Auth::user()->name, ['class' => 'form-control', 'disabled']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('slug', trans('blog::admin.posts.field.category_id'), ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'data-select']) !!}
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('blog::admin.posts.section.dates')</h3>
            </div>
            <div class="box-body">
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
            </div>
        </div>
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
                @include('blog::admin.posts.content', ['locale' => $locale])
            </div>
        @endforeach
    </div>
</div>

@section('scripts')
    <script src="{{ asset( 'vendor/ckeditor/ckeditor.js' )  }}"></script>
@stop