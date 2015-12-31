<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Modules\Menu\Entities\Menu;
use Vain\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::paginate();

        return view('menu::admin.items.index')->with(compact('menus'));
    }

    public function create()
    {
        $menus = Menu::paginate();

        return view('menu::admin.items.create')->with(compact('menus'));
    }

    public function store()
    {
        //
    }

    public function edit()
    {
        return view('menu::admin.items.edit')->with(compact('menus'));
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
