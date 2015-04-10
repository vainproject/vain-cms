<?php namespace Modules\Premium\Services\Payment\Paypal;

use Modules\Premium\Services\Payment\PaymentModel;
use Modules\User\Entities\User;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaypalModel extends PaymentModel {

    const DEFAULT_PAYMENT_METHOD = 'paypal';

    const DEFAULT_INTENT = 'sale';

    /**
     * Payment method being used - PayPal Wallet payment, Bank Direct Debit  or Direct Credit card.
     * Valid Values: ["credit_card", "bank", "paypal", "pay_upon_invoice", "carrier"]
     *
     * @var string
     */
    public $method;

    /**
     * Intent of the payment - Sale or Authorization or Order.
     * Valid Values: ["sale", "authorize", "order"]
     *
     * @var string
     */
    public $intent;

    /**
     * @var Payer
     */
    public $payer;

    /**
     * @var Transaction
     */
    public $transaction;

    function __construct($attributes = [])
    {
        $this->method = self::DEFAULT_PAYMENT_METHOD;
        $this->intent = self::DEFAULT_INTENT;

        parent::__construct($attributes);
    }

    /**
     * @param User $user
     * @return $this
     */
    public function withUser(User $user)
    {
        $instance = parent::withUser($user);

        // only possible if user is set
        $this->init();

        return $instance;
    }

    /**
     * processes all data and returns a paypal sdk payment object
     *
     * @param RedirectUrls $redirectUrls
     * @return Payment
     */
    public function payment(RedirectUrls $redirectUrls)
    {
        $payment = new Payment();
        $payment->setIntent($this->intent)
            ->setPayer($this->payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([ $this->transaction ]);

        return $payment;
    }

    /**
     * initializes the model with the paypal sdk
     */
    private function init()
    {
         // A resource representing a Payer that funds a payment
         // For paypal account payments, set payment method to 'paypal'.
        $this->payer = new Payer();
        $this->payer->setPaymentMethod($this->method);

        // Lets you specify a payment amount.
        // You can also specify additional details such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency($this->currency)
            ->setTotal($this->amount);

        // A transaction defines the contract of a payment - what is the
        // payment for and who is fulfilling it.
        $this->transaction = new Transaction();
        $this->transaction->setAmount($amount)
            ->setCustom($this->user->id)
            ->setDescription($this->description)
            ->setInvoiceNumber($this->identifier);
    }
}