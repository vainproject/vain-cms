<?php namespace Modules\Premium\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class PremiumController extends Controller {

    public function index()
    {
        return View::make('premium::admin.index');
    }

}