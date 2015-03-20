<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="{{ Auth::user()->getAvatar() }}" class="img-circle" alt="User Image" />
    </div>
    <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>@lang('user::user.title')</span> <i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
            <li><a href="{{ route('user.admin.users.index') }}"><i class="fa fa-circle-o"></i> @lang('user::user.title')</a></li>
            <li><a href="{{ route('user.admin.roles.index') }}"><i class="fa fa-circle-o"></i> @lang('user::role.title')</a></li>
            <li><a href="{{ route('user.admin.permissions.index') }}"><i class="fa fa-circle-o"></i> @lang('user::permission.title')</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="{{ route('index') }}">
            <i class="fa fa-file-text-o"></i> <span>@lang('site::admin.title')</span>
        </a>
    </li>
</ul>