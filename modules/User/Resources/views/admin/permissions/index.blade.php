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
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>@lang('user::permission.field.id')</td>
                            <td>@lang('user::permission.field.alias')</td>
                            <td>@lang('user::permission.field.name')</td>
                            <td>@lang('user::permission.field.description')</td>
                            <td>@lang('user::permission.field.created_at')</td>
                            <td>@lang('user::permission.field.updated_at')</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ $permission->created_at->diffForHumans() }}</td>
                                <td>{{ $permission->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @include('user::admin.partials.pagination', [ 'items' => $permissions ])
        </div>
    </section>
@endsection