<?php namespace Modules\Premium\Http\Controllers\Payment;

use GuzzleHttp\Client;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Session\Store;
use Modules\Premium\Http\Requests\ApprovalFormRequest;
use Modules\Premium\Http\Requests\PaymentFormRequest;
use Modules\Premium\Services\Payment\PaypalModel;
use Symfony\Component\HttpKernel\Exception\HttpException;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.paypal.enabled'))
                throw new HttpException(503);
        });
    }

    public function index(PaymentFormRequest $request)
    {
        $payment = (new PaypalModel($request->all()))
            ->withUser($request->user());

        return view('premium::payment.paypal.index', compact('payment'));
    }

    public function checkout(Request $request, ApiContext $apiContext)
    {
        $paypal = (new PaypalModel($request->all()))
            ->withUser($request->user());

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

        // log transaction in DB to update with IPN

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
     * Possible payment_status values
     *
     * Canceled_Reversal: A reversal has been canceled. For example, you won a dispute with the customer, and the funds for the transaction that was reversed have been returned to you.
     * Completed: The payment has been completed, and the funds have been added successfully to your account balance.
     * Created: A German ELV payment is made using Express Checkout.
     * Denied: You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the pending_reason variable or the Fraud_Management_Filters_x variable.
     * Expired: This authorization has expired and cannot be captured.
     * Failed: The payment has failed. This happens only if the payment was made from your customer’s bank account.
     * Pending: The payment is pending. See pending_reason for more information.
     * Refunded: You refunded the payment.
     * Reversed: A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from your account balance and returned to the buyer. The reason for the reversal is specified in the ReasonCode element.
     * Processed: A payment has been accepted.
     * Voided: This authorization has been voided.
     *
     * @param Request $request
     * @param Client $httpClient
     * @param Log $log
     * @return Response
     */
    public function callback(Request $request, Client $httpClient, Log $log)
    {
        // Choose url depend on env
        $url = $request->get('test_ipn', false)
            ? config('payment.providers.paypal.ipn.sandbox')
            : config('payment.providers.paypal.ipn.live');

        // Set up request to PayPal
        $httpRequest = $httpClient->post( $url, [
            'body' => [ 'cmd' => '_notify-validate' ] + $request->all()
        ]);

        // Execute request and get response and status code
        $httpResponse = $httpClient->send($httpRequest);

        if( $httpResponse->getStatusCode() != 200
            || $httpResponse->getBody() != 'VERIFIED')
        {
            // some unauthorized requests here, it may be clever to investigate
            $log->info('Unauthorized Paypal IPN call occured. See context for full request.', $request->all());
            app()->abort(403);
        }

        // TODO implement
        $userid = $request->get('custom');
        $tid = $request->get('txn_id');
        $currency = $request->get('mc_currency');
        $amount = $request->get('mc_gross');

        $status = strtoupper($request->get('payment_status'));

        switch ($status)
        {
            case 'PENDING':
                // log the transaction, even if its not completed
                break;

            case 'COMPLETED':
                // grant the donation amount to the donor

                // log the transaction in the log

                // delete entry from payment log
                break;

            case 'FAILED':
            case 'DENIED':
                // no currency granted
                // delete entry from payment log (if exists)
                break;

            default:
                // filter whitepage
                if ( ! empty($status)) {
                    // some unhandled ipn statuses, log them
                    $log->warning('Unhandled Paypal IPN call occured. See context for full request.', $request->all());
                }
                break;
        }
    }
}