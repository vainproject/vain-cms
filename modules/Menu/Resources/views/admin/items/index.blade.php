@extends('admin')

@section('title')
    @lang('menu::menu.title.index')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('menu::menu.title.index')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('menu.admin.items.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('menu::menu.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped" data-treegrid>
                    <thead>
                    <tr>
                        <td>@lang('menu::menu.field.target')</td>
                        <td>@lang('menu::menu.field.id')</td>
                        <td>@lang('menu::menu.field.visible')</td>
                        <td>@lang('menu::menu.field.title')</td>
                        <td>@lang('menu::menu.field.created_at')</td>
                        <td>@lang('menu::menu.field.updated_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $item)
                        <tr class="treegrid-{{ $item->id }} @if ($item->parent_id) treegrid-parent-{{ $item->parent_id }} @endif">
                            <td>
                                <div class="treegrid-wrapper">
                                    <small class="text-muted">{{ $item->action }}</small><br>
                                    {{ $item->target }}
                                </div>
                            </td>
                            <td>{{ $item->id }}</td>
                            <td>
                                {{-- this is a mutator which takes publish dates in consideration --}}
                                @if ($item->visible)
                                    <i class="text-success fa fa-check-circle"></i>
                                @else
                                    <i class="text-danger fa fa-minus-circle"></i>
                                @endif
                            </td>
                            <td>
                                {{ $item->content->title }}
                                @if ( $item->isFaulty() )
                                    <span data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ trans('menu::menu.error.broken') }}">
                                        <i class="text-red fa fa-exclamation-circle"></i>
                                    </span>
                                @elseif ( ! $item->hasChildren())
                                    <a href="{{ $item->url }}" target="_blank">
                                        <i class="fa fa-external-link"></i>
                                    </a>
                                @endif
                                <br>
                                <small class="text-muted">{{ $item->content->description }}</small>
                            </td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                     'class' => 'form-inline',
                                     'data-remote',
                                     'data-remote-success-message' => trans('menu::menu.delete.success'),
                                     'data-remote-error-message' => trans('menu::menu.delete.error'),
                                     'route' => ['menu.admin.items.destroy', $item->id],
                                     'method' => 'DELETE']) !!}
                                <a class="btn btn-sm btn-default" href="{{ route('menu.admin.items.edit', ['id' => $item->id]) }}"><i class="fa fa-edit"></i> @lang('menu::menu.action.edit')</a>
                                <button class="btn btn-sm btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i> @lang('menu::menu.action.delete')</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($menus->hasPages())
                <div class="box-footer">
                    {!! $menus->render(new Vain\Presenters\Pagination\BackendPresenter($menus)) !!}
                </div>
            @endif
        </div>
    </section>
    @include('menu::admin.modal')
@endsection

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>
@endsection