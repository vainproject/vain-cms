<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('title_'. $locale, trans('site::admin.name')) !!}
        {!! Form::date('title_'. $locale, isset($page) && ($content = $page->content($locale, false)) ? $content->title : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('keywords_'. $locale, trans('site::admin.keywords')) !!}
        {!! Form::date('keywords_'. $locale, isset($page) && ($content = $page->content($locale, false)) ? $content->keywords : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('description_'. $locale, trans('site::admin.description')) !!}
        {!! Form::date('description_'. $locale, isset($page) && ($content = $page->content($locale, false)) ? $content->description : '', ['class' => 'form-control']) !!}
    </div>
</div>

{!! Form::label('text_'. $locale, trans('site::admin.text')) !!}
<textarea id='text_{{ $locale }}' name='text_{{ $locale }}' data-editor data-editor-lang="{{ $locale }}">
        @if ($content = $page->content($locale, false))
        {!! $content->text !!}
    @endif
</textarea>