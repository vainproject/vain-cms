<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BitcoinController extends Controller {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.bitcoin.enabled'))
                throw new HttpException(503);
        });
    }

    public function index(Request $request)
    {
        return view('premium::payment.bitcoin.index', ['user' => $request->user()]);
    }

}