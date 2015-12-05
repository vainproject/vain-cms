<?php namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Vain\Packages\Translator\TranslatableContentTrait;

class MenuContent extends Model {

    use TranslatableContentTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['locale', 'title', 'description'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}