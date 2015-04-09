<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GiropayController extends Controller {

    public function index(Request $request)
    {
        return view('premium::payment.giropay.index', ['user' => $request->user()]);
    }

}