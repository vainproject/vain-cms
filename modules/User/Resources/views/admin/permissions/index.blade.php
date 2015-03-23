@extends('user::admin.index')

@section('title')
    @lang('user::permission.title')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('user::permission.title')
        </h1>
    </section>

    <section id="user" class="content">
        <div class="box">
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
                            <td></td>
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
                                <td>
                                    {!! Form::open([
                                        'class' => 'form-inline',
                                       'data-remote',
                                       'data-remote-success-message' => trans('user::permission.delete.success'),
                                       'data-remote-error-message' => trans('user::permission.delete.error'),
                                       'url' => route('user.admin.permissions.delete', ['id' => $permission->id]),
                                       'method' => 'DELETE']) !!}
                                        <a class="btn btn-default" href="{{ route('user.admin.permissions.edit', ['id' => $permission->id]) }}"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($permissions->hasPages())
                <div class="box-footer">
                    {!! $permissions->render(new Vain\Presenters\AdminLtePresenter($permissions)) !!}
                </div>
            @endif
        </div>
    </section>
    @include('user::admin.permissions.modal')
@endsection