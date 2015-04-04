<?php namespace Modules\User\Entities;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'color', 'order'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'ASC');
    }
}