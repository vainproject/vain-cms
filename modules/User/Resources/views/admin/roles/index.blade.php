@extends('user::admin.index')

@section('title')
    @lang('user::role.title.index')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('user::role.title.index')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('user.admin.roles.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('user::role.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped" data-target>
                    <thead>
                    <tr>
                        <td>@lang('user::role.id')</td>
                        <td>@lang('user::role.alias')</td>
                        <td>@lang('user::role.name')</td>
                        <td>@lang('user::role.description')</td>
                        <td>@lang('user::role.created_at')</td>
                        <td>@lang('user::role.updated_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td><span class="label label-role role-{{ $role->color }}">{{ $role->display_name }}</span></td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                     'class' => 'form-inline',
                                     'data-remote',
                                     'data-remote-success-message' => trans('user::role.delete.success'),
                                     'data-remote-error-message' => trans('user::role.delete.error'),
                                     'route' => ['user.admin.roles.destroy', $role->id],
                                     'method' => 'DELETE']) !!}
                                    <a class="btn btn-default" href="{{ route('user.admin.roles.edit', ['id' => $role->id]) }}"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('user::admin.partials.pagination', [ 'items' => $roles ])
        </div>
    </section>
    @include('user::admin.roles.modal')
@endsection