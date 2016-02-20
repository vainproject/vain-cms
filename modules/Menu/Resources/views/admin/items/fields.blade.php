<div class="form-group">
    {!! Form::label('visible', trans('menu::menu.field.visible'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {{-- little checkbox bool trick: http://nielson.io/2014/02/handling-checkbox-input-in-laravel/ --}}
        {!! Form::hidden('visible', false) !!}
        {!! Form::checkbox('visible', true, isset($menu) ? $menu->visible : null) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', trans('menu::menu.field.type'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::select('type', $types, null, ['class' => 'form-control']) !!}
    </div>
</div>

{{-- This section is only visible on type 'route' --}}
<div data-dependent-field="type" data-dependent-value="{{ $type = \Modules\Menu\Entities\Menu::TYPE_ROUTE }}">

    <div class="form-group">
        {!! Form::label('target['. $type .']', trans('menu::menu.field.target'), ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::select('target['. $type .']', array_keys( $routes ), isset($menu) ? array_search( $menu->target, array_keys( $routes ) ) : null, ['class' => 'form-control']) !!}
        </div>
    </div>

    @foreach($routes as $name => $route)
        <div class="form-group" data-dependent-field="target[{{ $type }}]" data-dependent-value="{{ array_search( $name, array_keys( $routes ) ) }}">
            {!! Form::label('parameters['. $name .']', trans('menu::menu.field.parameters'), ['class' => 'col-sm-3 control-label']) !!}
            @forelse($route as $param)
                <div class="col-sm-9">
                    {!! Form::text('parameters['. $name .']['. $param .']', isset($menu) && $name == $menu->target ? $menu->parameters[$param] : null, ['class' => 'form-control', 'placeholder' => $param]) !!}
                </div>
            @empty
                <div class="col-sm-9">
                    <p class="lead">@lang('menu::menu.error.parameters')</p>
                </div>
            @endforelse
        </div>
    @endforeach
</div>

{{-- This section is only visible on type 'url' --}}
<div class="form-group" data-dependent-field="type" data-dependent-value="{{ $type = \Modules\Menu\Entities\Menu::TYPE_URL }}">
    {!! Form::label('target['. $type .']', trans('menu::menu.field.target'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('target['. $type .']', isset($menu) ? $menu->target : null, ['class' => 'form-control']) !!}
    </div>
</div>