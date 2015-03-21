<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    protected $fillable = ['slug'];

    public function contents()
    {
        return $this->hasMany('Modules\Blog\Entities\CategoryContent');
    }

    public function posts()
    {
        return $this->hasMany('Modules\Blog\Entities\Post');
    }

    public function content($locale = null)
    {
        if ($locale === null) {
            $locale = app()->getLocale();
        }

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