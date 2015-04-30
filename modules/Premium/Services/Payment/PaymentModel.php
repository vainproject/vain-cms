<?php namespace Modules\Premium\Services\Payment;

use Modules\User\Entities\User;

class PaymentModel {

    const DEFAULT_CURRENCY = 'EUR';

    /**
     * description of what the transaction is about
     *
     * @var string
     */
    public $description;

    /**
     * transaction identifier, autogenerated
     *
     * @var string
     */
    public $identifier;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * object of the payer
     *
     * @var User
     */
    public $user;

    function __construct($attributes = [])
    {
        $this->currency = self::DEFAULT_CURRENCY;
        $this->identifier = $this->generateIdentifier();

        foreach ($attributes as $key => $value)
        {
            $this->{$key} = $value;
        }
    }

    /**
     * helper for object initialization
     *
     * @param User $user
     * @return $this
     */
    public function withUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    protected function generateIdentifier()
    {
        return md5( uniqid( time() ) );
    }
}