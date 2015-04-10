<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Session\Store;
use Symfony\Component\HttpKernel\Exception\HttpException;
use PayPal\Api\PaymentExecution;
use Modules\Premium\Services\Payment\PaymentProvider as ProviderContract;
use Modules\Premium\Services\Payment\Paypal\ApprovalFormRequest;
use Modules\Premium\Services\Payment\Paypal\CheckoutFormRequest;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller implements ProviderContract {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.paypal.enabled'))
                throw new HttpException(503);
        });
    }

    public function index(CheckoutFormRequest $request)
    {
        $payment = $request->getPaymentModel();

        return view('premium::payment.paypal.index', compact('payment'));
    }

    public function checkout(CheckoutFormRequest $request, ApiContext $apiContext)
    {
        $paypal = $request->getPaymentModel();

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('premium.payment.paypal.approve'))
            ->setCancelUrl(route('premium.payment.paypal.error'));

        $payment = $paypal->payment($redirectUrls)->create($apiContext);
        $approvalUrl = $payment->getApprovalLink();

        return redirect()->intended($approvalUrl);
    }

    public function approve(ApprovalFormRequest $request, ApiContext $apiContext, Store $session)
    {
        $payment = $request->getPayment($apiContext);
        $execution = $request->getExecution();

        $result = $payment->execute($execution, $apiContext); // if an exception is thrown, the payment is already executed
        $session->set('payment', $result);

        return redirect()->route('premium.payment.paypal.success');
    }

    /**
     * indicates that the payment finished with success
     *
     * @return Response
     */
    public function success()
    {
        dd(\Session::get('payment'));
        return view('premium::payment.paypal.success');
    }

    /**
     * indicates that the payment failed
     *
     * @return Response
     */
    public function error()
    {
        return view('premium::payment.paypal.error');
    }

    /**
     * callback used by the provider to verify the payment
     *
     * @return Response
     */
    public function callback()
    {
        return response();
    }
}