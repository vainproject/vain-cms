<?php namespace Modules\Premium\Http\Controllers;

use Illuminate\Routing\Controller;

class OrderController extends Controller {

    public function index()
    {
        return view('premium::order.index');
    }

}