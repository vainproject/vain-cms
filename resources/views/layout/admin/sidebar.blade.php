<!-- Sidebar user panel -->
@yield('userpanel')

<div class="sidebar-form">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{ trans('admin.search') }}" data-menu-search="section" autofocus>
          <span class="input-group-btn">
              <span class="btn btn-flat"><i class="fa fa-search"></i></span>
          </span>
    </div>
</div>

{!! (new \Vain\Presenters\Menu\AdminLtePresenter())->render($menu) !!}