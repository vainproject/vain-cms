<?php namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {

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
}