<?php namespace Modules\Menu\Entities;

use Baum\Node as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Vain\Packages\Translator\TranslatableTrait;

class Menu extends Model
{
    use TranslatableTrait;

    const TYPE_ROUTE = 1;

    const TYPE_URL = 2;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * @var array
     */
    protected $fillable = ['type', 'target', 'parameters', 'published_at', 'concealed_at'];

    /**
     * @var array
     */
    protected $dates = ['published_at', 'concealed_at', 'created_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(MenuContent::class);
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where(function($query) {

            $query->where('visible', true);

            $query->where(function($query) {
                $query->where('published_at', '<=', Carbon::now())
                    ->orWhere('published_at', null);
            });

            $query->where(function($query) {
                $query->where('concealed_at', '>=', Carbon::now())
                    ->orWhere('concealed_at', null);
            });
        });
    }

    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    /**
     * fix optional empty dates
     *
     * @param $value
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = !empty($value)
            ? $value
            : null;
    }

    /**
     * fix optional empty dates
     *
     * @param $value
     */
    public function setConcealedAtAttribute($value)
    {
        $this->attributes['concealed_at'] = !empty($value)
            ? $value
            : null;
    }

    /**
     * @param $value
     * @return array
     */
    public function getParametersAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     */
    public function setParametersAttribute($value)
    {
        $this->attributes['parameters'] = json_encode($value);
    }
}