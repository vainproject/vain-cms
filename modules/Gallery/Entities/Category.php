<?php namespace Modules\Gallery\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Modules\User\Entities\User;
use Vain\Packages\Translator\TranslatableTrait;

class Category extends Model {

    use TranslatableTrait, LocalizedEloquentTrait;

    protected $fillable = ['slug'];

    protected $table = "gallery_categories";

    public function contents()
    {
        return $this->hasMany(CategoryContent::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}