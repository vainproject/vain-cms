<?php namespace Modules\User\Entities;

use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    use LocalizedEloquentTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];
}