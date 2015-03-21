<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories_content';

    protected $fillable = ['name', 'locale'];

    public function category()
    {
        return $this->belongsTo('Modules\Blog\Entities\Category');
    }
}