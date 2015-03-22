<?php namespace Modules\Site\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\Translatable as TranslatableContract;
use Vain\Packages\Translator\TranslatableTrait;

class Page extends Model implements TranslatableContract {

    use TranslatableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'slug', 'role', 'active', 'published_at', 'concealed_at' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany('Modules\Site\Entities\Content');
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('active', true)
            ->where('published_at', '<=', Carbon::now())
            ->orWhere('published_at', null)
            ->where('concealed_at', '>=', Carbon::now())
            ->orWhere('concealed_at', null);
    }

}
