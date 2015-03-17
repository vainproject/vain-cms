<?php namespace Vain\Packages\RealmAPI\Models;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\RealmAPI\RealmAPI;
use Illuminate\Support\Facades\Lang;

class Character extends Model
{

    protected $table = 'characters';
    protected $guarded = ['*'];
    protected $connection = '-'; // the connection will be defined when the character is loaded via realm api
    protected $primaryKey = 'guid';

    public function account()
    {
        return $this->belongsTo('Vain\Packages\RealmAPI\Models\Account');
    }

    public function getRealmidAttribute()
    {
        switch ($this->connection) {
            case 'mangos_characters':
                return RealmAPI::REALM_MANGOS;
            case 'trinity_characters':
                return RealmAPI::REALM_TRINITY;
            default:
                throw new \InvalidArgumentException; // ToDo: own exception
        }
    }

    public function getRacenameAttribute()
    {
        return Lang::get('data/races.' . $this->race);
    }

    public function getClassnameAttribute()
    {
        return Lang::get('data/classes.' . $this->class);
    }

}
