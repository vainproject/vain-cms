@extends('user::admin.index')

@section('title')
    @lang('user::permission.title.index')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('user::permission.title.index')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn-success" href="asd"><i class="fa fa-plus-circle"></i> New</a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>@lang('user::permission.id')</td>
                            <td>@lang('user::permission.alias')</td>
                            <td>@lang('user::permission.name')</td>
                            <td>@lang('user::permission.description')</td>
                            <td>@lang('user::permission.created_at')</td>
                            <td>@lang('user::permission.updated_at')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td>{{ $permission->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($permissions->hasPages())
                <div class="box-footer">
                    <div class="pull-right">
                        {!! $permissions->render(new Vain\Presenters\Pagination\AdminLtePresenter($permissions)) !!}
                    </div>

                    <div class="clearfix"></div>
                </div>
            @endif
        </div>
    </section>
@endsection