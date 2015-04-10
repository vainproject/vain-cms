<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Premium\Services\Payment\PaymentFormRequest;
use Modules\Premium\Services\Payment\PaymentModel;
use Modules\Premium\Services\Payment\PaymentProvider as ProviderContract;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller implements ProviderContract {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.paypal.enabled'))
                throw new HttpException(503);
        });
    }

    public function index(PaymentFormRequest $request)
    {
        $payment = new PaymentModel($request->all());

        $credentials = new OAuthTokenCredential(config('payment.providers.paypal.client_id'), config('payment.providers.paypal.client_secret'));
        $apiContext = new ApiContext($credentials);

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => storage_path('logs/paypal-'. date('Y-m-d') .'.log'),
                'log.LogLevel' => 'FINE'
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $amount = new Amount();
        $amount->setCurrency($payment->currency)
            ->setTotal($payment->amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Payment description")
            ->setInvoiceNumber($payment->transaction);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('premium.payment.paysafe.success'))
            ->setCancelUrl(route('premium.payment.paysafe.error'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([ $transaction ]);

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
           // could error
        }

        $approvalUrl = $payment->getApprovalLink();
        return redirect()->intended($approvalUrl);

//        return view('premium::payment.paypal.index', compact('payment'));
    }

    /**
     * indicates that the payment finished with success
     *
     * @return Response
     */
    public function success()
    {
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