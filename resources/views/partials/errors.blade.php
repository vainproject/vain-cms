@if ($errors->any())
    <div class="alert alert-danger">
        <strong>@lang('app.errors.whops')</strong> {{ $message }}<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif