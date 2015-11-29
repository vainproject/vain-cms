<?php namespace Modules\Gallery\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Modules\User\Entities\User;
use Vain\Packages\Translator\TranslatableTrait;

class Photo extends Model {

    use TranslatableTrait, LocalizedEloquentTrait;

    protected $fillable = ['path', 'slug'];

    protected $table = "gallery_photos";

    public function contents()
    {
        return $this->hasMany(PhotoContent::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}