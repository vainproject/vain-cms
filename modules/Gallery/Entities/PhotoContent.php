<?php namespace Modules\Gallery\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class PhotoContent extends Model {

    use TranslatableContentTrait;

    protected $fillable = ['locale', 'title', 'keywords', 'description'];

    protected $table = "gallery_photos_content";


    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

}