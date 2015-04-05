<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('title_'. $locale, trans('site::page.field.name')) !!}
        {!! Form::text('title_'. $locale, isset($page) && ($content = $page->content($locale, false)) ? $content->title : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('keywords_'. $locale, trans('site::page.field.keywords')) !!}
        {!! Form::text('keywords_'. $locale, isset($page) && ($content = $page->content($locale, false)) ? $content->keywords : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('description_'. $locale, trans('site::page.field.description')) !!}
        {!! Form::textarea('description_'. $locale, isset($page) && ($content = $page->content($locale, false)) ? $content->description : '', ['class' => 'form-control', 'data-expand', 'data-expand-rows-max' => '6', 'rows' => '2']) !!}
    </div>
</div>

{!! Form::label('text_'. $locale, trans('site::page.field.text')) !!}
<textarea id='text_{{ $locale }}' name='text_{{ $locale }}' data-editor data-editor-lang="{{ $locale }}">
        @if ($content = isset($page) ? $page->content($locale, false) : null)
        {!! $content->text !!}
    @endif
</textarea>