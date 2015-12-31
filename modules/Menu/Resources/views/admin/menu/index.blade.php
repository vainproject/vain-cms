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
                <a class="btn btn btn-primary" href="{{ route('site.admin.sites.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('menu::menu.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('menu::menu.field.id')</td>
                        <td>@lang('menu::menu.field.slug')</td>
                        <td>@lang('menu::menu.field.slug')</td>
                        <td>@lang('menu::menu.field.published_at')</td>
                        <td>@lang('menu::menu.field.concealed_at')</td>
                        <td>@lang('menu::menu.field.created_at')</td>
                        <td>@lang('menu::menu.field.updated_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->target }}</td>
                            <td>{{ $item->content->title }} <a href="{{ $item->url }}" target="_blank"><i class="fa fa-external-link"></i></a></td>
                            <td>{{ isset($item->published_at) ? $item->published_at->diffForHumans() : '' }}</td>
                            <td>{{ isset($item->concealed_at) ? $item->concealed_at->diffForHumans() : '' }}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                     'class' => 'form-inline',
                                     'data-remote',
                                     'data-remote-success-message' => trans('menu::menu.delete.success'),
                                     'data-remote-error-message' => trans('menu::menu.delete.error'),
                                     'route' => ['site.admin.sites.destroy', $item->id],
                                     'method' => 'DELETE']) !!}
                                <a class="btn btn-sm btn-default" href="{{ route('site.admin.sites.edit', ['id' => $item->id]) }}"><i class="fa fa-edit"></i> @lang('menu::menu.action.edit')</a>
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