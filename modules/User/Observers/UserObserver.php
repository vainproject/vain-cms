<?php

namespace Modules\User\Observers;

class UserObserver {

    protected $relations = [
        'sites',
        'posts',
        'comments'
    ];

    /**
     * Post delete check if a user has any relevant relations,
     * if so we cancel the deletion and ask the user to
     * manually remove all relations for now.
     *
     * @param $model
     * @return bool
     */
    public function deleting($model)
    {
        foreach ($this->relations as $relation) {
            if ($model->{$relation}()->count() > 0) {
                // Returning false from an Eloquent event listener will cancel the operation.
                return false;
            }
        }
    }

}