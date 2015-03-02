<?php namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class ApiController extends Controller {

	public function index()
	{
		return View::make('api::index');
	}
	
}