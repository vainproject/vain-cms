<?php namespace Modules\Site\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class SiteController extends Controller {

    public function index()
    {
        return View::make('site::index');
    }
    
}