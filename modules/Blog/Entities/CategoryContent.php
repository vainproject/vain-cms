<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'post_categories_content';

    /**
     * @var array
     */
    protected $fillable = ['name', 'locale'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('Modules\Blog\Entities\Category');
    }
}