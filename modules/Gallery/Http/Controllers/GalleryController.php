<?php namespace Modules\Gallery\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class GalleryController extends Controller {
	
	public function index()
	{
		return view('gallery::index');
	}
	
}