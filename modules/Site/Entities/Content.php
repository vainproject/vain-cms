<?php namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableFillTrait;

class Content extends Model {

    use TranslatableFillTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'locale', 'title', 'keywords', 'description', 'text' ];

    public function page()
    {
        return $this->belongsTo('Modules\Site\Entities\Page');
    }

    /**
     * basicly used to update a localization with ease
     *
     * @param $query
     * @param $locale
     * @return static
     */
    public function scopeLocaleOrNew($query, $locale)
    {
        $obj = $query->where('locale', $locale)->first();
        return $obj ?: new static;
    }
}