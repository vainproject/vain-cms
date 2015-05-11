<?php namespace Modules\Premium\Entities;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trial_ends_at',
        'subscription_ends_at',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'trial_ends_at',
        'subscription_ends_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo('Modules\Premium\Entities\Plan');
    }
}
