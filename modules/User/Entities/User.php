<?php namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword, EntrustUserTrait, LocalizedEloquentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alias',
        'birthday_at',
        'locale',
        'gender',
        'city',
        'profession',
        'hobbies',
        'homepage',
        'skype',
        'facebook',
        'twitter',
        'main_character',
        'main_guild',
        'favorite_race',
        'favorite_class',
        'favorite_spec',
        'favorite_instance',
        'favorite_battleground'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * created static pages
     */
    public function sites()
    {
        $this->hasMany('Modules\Site\Entities\Page');
    }

    /**
     * @return String
     */
    public function getAvatar()
    {
        // TODO user option for gravatar && check and maybe provide own avatar engine

        return app('Modules\User\Services\Gravatar')
            ->getGravatar($this->email);
    }
}
