<?php namespace Modules\Menu\Entities;

use Baum\Node as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Vain\Packages\Translator\TranslatableTrait;

class Menu extends Model
{
    use TranslatableTrait;

    const URL_EMPTY = '#';

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

    public function getActionAttribute($value)
    {
        switch ($this->type)
        {
            case Menu::TYPE_ROUTE:
                return trans('menu::menu.field.type.route');

            case Menu::TYPE_URL:
                return trans('menu::menu.field.type.extern');

            default:
                return trans('menu::menu.field.type.unknown');
        }
    }

    /**
     * builds the targeting url based upon the given
     * type if the current item
     *
     * @param $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        if ($this->hasChildren())
        {
            return static::URL_EMPTY;
        }

        switch ($this->type)
        {
            case Menu::TYPE_ROUTE:
                return route($this->target, $this->parameters);

            case Menu::TYPE_URL:
                return $this->target;

            default:
                return null;
        }
    }
}