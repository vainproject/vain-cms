<?php namespace Modules\Menu\Http\Controllers\Admin;

use Modules\Menu\Entities\Menu;
use Vain\Http\Controllers\Controller;

class MenuController extends Controller {
	
	public function index()
	{
		$menus = Menu::paginate();

		return view('menu::admin.menu.index')->with( compact( 'menus' ) );
	}
	
}