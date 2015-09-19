<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class PostContent extends Model {

    use TranslatableContentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_posts_content';

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