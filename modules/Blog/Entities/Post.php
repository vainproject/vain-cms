<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = ['slug', 'role', 'published_at', 'concealed_at'];

    public function contents()
    {
        return $this->hasMany('Modules\Blog\Entities\PostContent');
    }

    public function user()
    {
        return $this->hasMany('Modules\User\Entities\User');
    }

    public function category()
    {
        return $this->belongsTo('Modules\Blog\Entities\Category');
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