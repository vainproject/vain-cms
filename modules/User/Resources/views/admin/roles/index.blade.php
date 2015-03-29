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
            <div class="box-body table-responsive no-padding" data-pjax>
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
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
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
            @if ($roles->hasPages())
                <div class="box-footer">
                    {!! $roles->render(new Vain\Presenters\Pagination\AdminLtePresenter($roles)) !!}
                </div>
            @endif
        </div>
    </section>
    @include('user::admin.roles.modal')
@endsection