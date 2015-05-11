<?php namespace Modules\Premium\Entities;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model {

    /**
     * @var string
     */
    protected $table = 'payment_exchange_rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'amount',
        'valid_from',
        'valid_to',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'valid_from',
        'valid_to',
    ];

}
