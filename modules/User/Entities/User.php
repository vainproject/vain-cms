<?php namespace Modules\User\Entities;

use Carbon\Carbon;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Vain\Packages\Access\Contracts\UserInterface as UserContract;
use Vain\Packages\Access\Traits\UserTrait;

class User extends Model implements UserContract, AuthenticatableContract, CanResetPasswordContract {

    use UserTrait, Authenticatable, CanResetPassword, LocalizedEloquentTrait, Messagable;

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
        return $this->hasMany('Modules\Site\Entities\Page');
    }

    public function posts()
    {
        return $this->hasMany('Modules\Blog\Entities\Post');
    }

    public function payments()
    {
        return $this->hasMany('Modules\Premium\Entities\Payment');
    }

    public function comments()
    {
        return $this->hasMany('Modules\Blog\Entities\Comment');
    }

    /**
     * queries all possible online users
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function scopeOnline($query)
    {
        $expiryDate = Carbon::now()
            ->subMinutes(config('session.lifetime'));

        return $query->where('last_active_at', '>', $expiryDate)
            ->andWhere('logged_out', false);
    }

    /**
     * accessor for current online state
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getOnlineAttribute($value)
    {
        $expiryDate = Carbon::now()
            ->subMinutes(config('session.lifetime'));

        return ( ! $this->logged_out)
            && $expiryDate->lt($this->last_active_at);
    }

    /**
     * accessor for the users avatar
     *
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAvatarAttribute($value)
    {
        return $this->getAvatar();
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
