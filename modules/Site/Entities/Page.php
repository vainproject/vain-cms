<?php namespace Modules\Site\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {

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

    public function contents()
    {
        return $this->hasMany('Modules\Site\Entities\Content');
    }

    /**
     * @return mixed
     */
    public static function published()
    {
        return static::where('active', true)
            ->where('published_at', '<=', Carbon::now())
            ->orWhere('published_at', null)
            ->where('concealed_at', '>=', Carbon::now())
            ->orWhere('concealed_at', null);
    }

    /**
     * @param null $locale
     * @return Content
     */
    public function content($locale = null)
    {
        if ($locale === null)
        {
            $locale = app()->getLocale();
        }

        $content = $this->contents()
            ->where('locale', $locale)
            ->first();

        // todo better fallback
        if ($content === null)
        {
            $content = $this->contents()
                ->first();
        }

        return $content;
    }
}
