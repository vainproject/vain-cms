<?php namespace Modules\Support\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class SupportController extends Controller {
	
	public function index()
	{
		return view('support::index');
	}
	
}