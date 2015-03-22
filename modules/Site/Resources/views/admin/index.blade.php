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
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('site::admin.id')</td>
                        <td>@lang('site::admin.slug')</td>
                        <td>@lang('site::admin.role')</td>
                        <td>@lang('site::admin.published_at')</td>
                        <td>@lang('site::admin.concealed_at')</td>
                        <td>@lang('site::admin.created_at')</td>
                        <td>@lang('site::admin.updated_at')</td>
                        <td>@lang('site::admin.deleted_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>{{ $page->role }}</td>
                            <td>{{ $page->published_at }}</td>
                            <td>{{ $page->concealed_at }}</td>
                            <td>{{ $page->created_at }}</td>
                            <td>{{ $page->updated_at }}</td>
                            <td>{{ $page->deleted_at }}</td>
                            <td>
                                <a class="btn-sm btn-default" href="{{ route('site.admin.pages.edit', ['id' => $page->id]) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn-sm btn-danger" href="{{ route('site.admin.pages.delete', ['id' => $page->id]) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $pages->render(new Vain\Presenters\AdminLtePresenter($pages)) !!}
            </div>
        </div>
    </section>
@endsection