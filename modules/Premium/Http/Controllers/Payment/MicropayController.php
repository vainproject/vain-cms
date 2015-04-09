<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class MicropayController extends Controller {

    public function index()
    {
        return View::make('premium::index');
    }

}