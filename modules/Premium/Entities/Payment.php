<?php namespace Modules\Premium\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction',
        'provider',
        'value',
        'currency',
        'amount',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }
    
}
