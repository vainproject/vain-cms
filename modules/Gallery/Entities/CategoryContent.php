<?php namespace Modules\Gallery\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class CategoryContent extends Model {

    use TranslatableContentTrait;

    protected $fillable = ['locale', 'name'];

    protected $table = "gallery_categories_content";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}