<?php namespace Modules\Menu\Http\Controllers\Admin;

use Vain\Http\Controllers\Controller;

class MenuController extends Controller {
	
	public function index()
	{
		return view('menu::index');
	}
	
}