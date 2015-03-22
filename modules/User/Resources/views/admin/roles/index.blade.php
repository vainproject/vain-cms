@extends('user::admin.index')

@section('title')
    @lang('user::role.title')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('user::role.title')
        </h1>
    </section>

    <section id="user" class="content">

        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
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
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                <a class="btn-sm btn-default" href="{{ route('user.admin.roles.edit', ['id' => $role->id]) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn-sm btn-danger js-delete" href="{{ route('user.admin.roles.delete', ['id' => $role->id]) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {!! $roles->render(new Vain\Presenters\AdminLtePresenter($roles)) !!}
            </div>
        </div>
    </section>
    @include('user::admin.roles.modal')
@endsection