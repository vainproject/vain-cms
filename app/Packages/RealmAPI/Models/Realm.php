<?php namespace Vain\Packages\RealmAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Realm extends Model {

    protected $table = 'realmlist';
    protected $guarded = ['*'];
    protected $connection = 'logon';

}
