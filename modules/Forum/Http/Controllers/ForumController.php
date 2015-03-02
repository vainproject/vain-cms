<?php namespace Modules\Forum\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class ForumController extends Controller {

	public function index()
	{
		return View::make('forum::index');
	}
	
}