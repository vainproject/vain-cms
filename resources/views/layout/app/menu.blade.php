<div id="menu" class="menu-right">
    <ul>
        {{-- Search form --}}
        {{-- TODO: inject this by "search" module or something like this --}}
        {{--<form class="menu-search" >--}}
            {{--<div class="form-group header">--}}
                {{--<i class="icon-search searchico"></i>--}}
                {{--<input type="text" placeholder="{{ trans('vain::app.search') }}">--}}
                {{--<a href="#" class="close-menu"><i class="icon-close"></i></a>--}}
            {{--</div>--}}
        {{--</form>--}}

        {{-- General menu items --}}
        {!! (new \Vain\Presenters\Menu\FrontendPresenter())->render($menu) !!}
    </ul>
</div>