<?php namespace Modules\Blog\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $fillable = ['text', 'bluepost'];

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function post()
    {
        return $this->belongsTo('Modules\Blog\Entities\Post');
    }
}