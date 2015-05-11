<?php namespace Modules\Premium\Entities;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model {

    /**
     * @var string
     */
    protected $table = 'subscription_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'amount',
        'duration',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasManyThrough(
            'Modules\User\Entities\User',
            'Modules\Premium\Entities\Subscription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany('Modules\Premium\Entities\Subscription');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(
            config('entrust.role'),
            config('entrust.role_user_table'),
            'user_id',
            'role_id');
    }
}
