<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GiropayController extends Controller {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.giropay.enabled'))
                throw new HttpException(503);
        });
    }

    public function index(Request $request)
    {
        return view('premium::payment.giropay.index', ['user' => $request->user()]);
    }

}