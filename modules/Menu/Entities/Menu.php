<?php

namespace Modules\Menu\Entities;

use Baum\Node as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\Menu\Contracts\MenuItemInterface as MenuItemContract;
use Modules\Menu\Traits\MenuItemTrait;
use Vain\Packages\Translator\TranslatableTrait;

class Menu extends Model implements MenuItemContract
{
    use MenuItemTrait, TranslatableTrait;

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
     *
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where(function ($query) {

            $query->where('visible', true);

            $query->where(function ($query) {
                $query->where('published_at', '<=', Carbon::now())
                    ->orWhere('published_at', null);
            });

            $query->where(function ($query) {
                $query->where('concealed_at', '>=', Carbon::now())
                    ->orWhere('concealed_at', null);
            });
        });
    }

    /**
     * @param $value
     * @return bool
     */
    public function getVisibleAttribute($value)
    {
        if ($value) {
            // if we are willing to show the item we consider time boundaries if there are any
            if ($this->published_at instanceof Carbon) {
                // if the publish date is in the past we can
                // savely show the menu entry
                $value = $this->published_at->isPast();
            }

            if ($value && $this->concealed_at instanceof Carbon) {
                // if the visibility before is true and the conceal date
                // is in the future we can show the menu entry
                $value = $this->concealed_at->isFuture();
            }
        }

        return $value;
    }

    /**
     * fix optional empty dates.
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
     * fix optional empty dates.
     *
     * @param $value
     */
    public function setConcealedAtAttribute($value)
    {
        $this->attributes['concealed_at'] = !empty($value)
            ? $value
            : null;
    }
}
