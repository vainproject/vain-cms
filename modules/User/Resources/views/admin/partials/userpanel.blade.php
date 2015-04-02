<div class="user-panel">
    <div class="pull-left image">
        <img src="{{ $user->avatar }}" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
        <p>{{ $user->name }}</p>

        <a href="#"><i class="fa fa-circle @if ($user->online)text-success @else text-danger @endif"></i> Online</a>
    </div>
</div>
