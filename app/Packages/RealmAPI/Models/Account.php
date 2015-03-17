<?php namespace Vain\Packages\RealmAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model {

    protected $table = 'account';
    protected $guarded = ['*'];
    protected $connection = 'logon';

}
