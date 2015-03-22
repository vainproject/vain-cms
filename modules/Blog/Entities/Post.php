<?php namespace Modules\Blog\Entities;
   
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = ['slug', 'role', 'published_at', 'concealed_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany('Modules\Blog\Entities\PostContent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->hasMany('Modules\User\Entities\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Modules\Blog\Entities\Category');
    }

    /**
     * @return mixed
     */
    public function getContentAttribute()
    {
        $locale = app()->getLocale();

        $content = $this->contents()
            ->where('locale', $locale)
            ->first();

        if ($content === null) {
            $content = $this->contents()
                ->first();
        }

        return $content;
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now())
            ->orWhere('published_at', null)
            ->where('concealed_at', '>=', Carbon::now())
            ->orWhere('concealed_at', null);
    }
}