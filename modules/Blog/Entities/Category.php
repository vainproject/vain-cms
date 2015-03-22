<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_categories';

    /**
     * @var array
     */
    protected $fillable = ['slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany('Modules\Blog\Entities\CategoryContent');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('Modules\Blog\Entities\Post');
    }

    /**
     * Tries to get the translated content for the current locale
     * Otherwise we'll take the first translated content for this category
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
}