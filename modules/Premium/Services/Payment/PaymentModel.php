<?php namespace Modules\Premium\Services\Payment;

use ReflectionClass;
use Modules\User\Entities\User;

class PaymentModel {

    const DEFAULT_CURRENCY = 'EUR';

    /**
     * @var string
     */
    public $transaction;

    /**
     * @var float
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var User
     */
    public $user;

    function __construct($attributes = [])
    {
        $this->currency = self::DEFAULT_CURRENCY;
        $this->transaction = $this->generateTransaction();

        foreach ($attributes as $key => $value)
        {
            $this->{$key} = $value;
        }

//        $this->formatAttributes();
    }

    /**
     * @return string
     */
    protected function generateTransaction()
    {
        return md5( uniqid( time() ) );
    }

    /**
     * format value decimal point, etc
     */
//    protected function formatAttributes()
//    {
//        $properties = (new ReflectionClass($this))->getProperties();
//        foreach ($properties as $property)
//        {
//            $name = $property->getName();
//            $value = $property->getValue($this);
//
//            if ($name == 'amount')
//            {
//                $this->{$name} = str_replace('.', ',', $value);
//            }
//        }
//    }
}