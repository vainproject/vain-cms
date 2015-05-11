<?php namespace Modules\Premium\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    const STATUS_FAILED = 'failed';

    const STATUS_COMPLETE = 'complete';

    const STATUS_PENDING = 'pending';

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
