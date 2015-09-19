@extends('admin')

@section('title')
    @lang('site::page.title.index')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('site::page.title.index')
        </h1>
    </section>

    <section class="content">

        @include('site::admin.statistic')

        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('site.admin.sites.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('site::page.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('site::page.field.id')</td>
                        <td>@lang('site::page.field.creator')</td>
                        <td>@lang('site::page.field.slug')</td>
                        <td>@lang('site::page.field.role')</td>
                        <td>@lang('site::page.field.published_at')</td>
                        <td>@lang('site::page.field.concealed_at')</td>
                        <td>@lang('site::page.field.created_at')</td>
                        <td>@lang('site::page.field.updated_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>@userbadge($page->user)</td>
                            <td>{{ $page->slug }} <a href="{{ route('site.show', ['slug' => $page->slug]) }}" target="_blank"><i class="fa fa-external-link"></i></a></td>
                            <td>{{ $page->role }}</td>
                            <td>{{ isset($page->published_at) ? $page->published_at->diffForHumans() : '' }}</td>
                            <td>{{ isset($page->concealed_at) ? $page->concealed_at->diffForHumans() : '' }}</td>
                            <td>{{ $page->created_at->diffForHumans() }}</td>
                            <td>{{ $page->updated_at->diffForHumans() }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                     'class' => 'form-inline',
                                     'data-remote',
                                     'data-remote-success-message' => trans('site::page.delete.success'),
                                     'data-remote-error-message' => trans('site::page.delete.error'),
                                     'route' => ['site.admin.sites.destroy', $page->id],
                                     'method' => 'DELETE']) !!}
                                <a class="btn btn-sm btn-default" href="{{ route('site.admin.sites.edit', ['id' => $page->id]) }}"><i class="fa fa-edit"></i> @lang('site::page.action.edit')</a>
                                <button class="btn btn-sm btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i> @lang('site::page.action.delete')</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($pages->hasPages())
                <div class="box-footer">
                    {!! $pages->render(new Vain\Presenters\Pagination\BackendPresenter($pages)) !!}
                </div>
            @endif
        </div>
    </section>
    @include('site::admin.modal')
@endsection