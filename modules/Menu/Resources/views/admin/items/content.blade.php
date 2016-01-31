<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('title_'. $locale, trans('menu::menu.field.title')) !!}
        {!! Form::text('title_'. $locale, isset($menu) && ($content = $menu->content($locale, false)) ? $content->title : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::label('description_'. $locale, trans('menu::menu.field.description')) !!}
        {!! Form::textarea('description_'. $locale, isset($menu) && ($content = $menu->content($locale, false)) ? $content->description : '',
            ['class' => 'form-control', 'data-expand', 'rows' => 2, 'data-expand-rows-max' => 8]) !!}
    </div>
</div>