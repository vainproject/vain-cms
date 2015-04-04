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
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('user::user.id')</td>
                        <td>@lang('user::profile.field.name')</td>
                        <td>@lang('user::profile.field.email')</td>
                        <td>@lang('user::profile.field.gender')</td>
                        <td>@lang('user::profile.field.locale')</td>
                        <td>@lang('user::user.created_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ config(sprintf('app.locales.%s', $user->locale)) }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                {!! Form::open([
                                    'class' => 'form-inline',
                                    'data-remote',
                                    'data-remote-success-message' => trans('user::user.delete.success'),
                                    'data-remote-error-message' => trans('user::user.delete.error'),
                                    'route' => ['user.admin.users.destroy', $user->id],
                                    'method' => 'DELETE']) !!}
                                    <a class="btn btn-default" href="{{ route('user.admin.users.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($users->hasPages())
                <div class="box-footer">
                    {!! $users->render(new Vain\Presenters\Pagination\AdminLtePresenter($users)) !!}
                </div>
            @endif
        </div>
    </section>
    @include('user::admin.users.modal')
@endsection