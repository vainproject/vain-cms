<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;

class PostContent extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts_content';

    /**
     * @var array
     */
    protected $fillable = ['locale', 'title', 'text', 'keywords', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('Modules\Blog\Entities\Post');
    }
}