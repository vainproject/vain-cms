@extends('user::admin.index')

@section('title')
    @lang('user::user.title.index')
@stop

@section('content')
    <section class="content-header">
        <h1>
            @lang('user::user.title.index')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('user.admin.users.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('user::user.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('user::user.field.id')</td>
                        <td>@lang('user::profile.field.name')</td>
                        <td>@lang('user::profile.field.email')</td>
                        <td>@lang('user::profile.field.gender')</td>
                        <td>@lang('user::profile.field.locale')</td>
                        <td>@lang('user::user.field.created_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>@userbadge($user)</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ config(sprintf('app.locales.%s', $user->locale)) }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                    'class' => 'form-inline',
                                    'data-remote',
                                    'data-remote-success-message' => trans('user::user.delete.success'),
                                    'data-remote-error-message' => trans('user::user.delete.error'),
                                    'route' => ['user.admin.users.destroy', $user->id],
                                    'method' => 'DELETE']) !!}
                                    <a class="btn btn-default" href="{{ route('user.admin.users.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i> @lang('user::user.action.edit')</a>
                                    <button class="btn btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i> @lang('user::user.action.delete')</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('user::admin.partials.pagination', [ 'items' => $users ])
        </div>
    </section>
    @include('user::admin.users.modal')
@endsection