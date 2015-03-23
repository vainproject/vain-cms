@extends('admin')

@section('title')
    @lang('site::admin.title')
@stop

@section('styles')
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('site::admin.title')
        </h1>
    </section>

    <section class="content">

        @include('site::admin.statistic')

        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('site::admin.id')</td>
                        <td>@lang('site::admin.creator')</td>
                        <td>@lang('site::admin.slug')</td>
                        <td>@lang('site::admin.role')</td>
                        <td>@lang('site::admin.published_at')</td>
                        <td>@lang('site::admin.concealed_at')</td>
                        <td>@lang('site::admin.created_at')</td>
                        <td>@lang('site::admin.updated_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td><a class="label label-primary" href="{{ route('user.admin.users.edit', ['id' => $page->user->id]) }}">{{ $page->user->name }}</a></td>
                            <td>{{ $page->slug }} <a href="{{ route('site.show', ['slug' => $page->slug]) }}" target="_blank"><i class="fa fa-external-link"></i></a></td>
                            <td>{{ $page->role }}</td>
                            <td>{{ $page->published_at }}</td>
                            <td>{{ $page->concealed_at }}</td>
                            <td>{{ $page->created_at }}</td>
                            <td>{{ $page->updated_at }}</td>
                            <td>
                                {!! Form::open([
                                     'class' => 'form-inline',
                                     'data-remote',
                                     'data-remote-success-message' => trans('site::admin.delete.success'),
                                     'data-remote-error-message' => trans('site::admin.delete.error'),
                                     'url' => route('site.admin.pages.delete', ['id' => $page->id]),
                                     'method' => 'DELETE']) !!}
                                <a class="btn btn-default" href="{{ route('site.admin.pages.edit', ['id' => $page->id]) }}"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($pages->hasPages())
                <div class="box-footer">
                    {!! $pages->render(new Vain\Presenters\AdminLtePresenter($pages)) !!}
                </div>
            @endif
        </div>
    </section>
    @include('site::admin.modal')
@endsection