<?php namespace Modules\Message\Entities;

use Cmgmyr\Messenger\Models\Message as MessengerMessage;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Emojione\Emojione;

class Message extends MessengerMessage {

    use LocalizedEloquentTrait;

    /**
     * Thread relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('Modules\Message\Entities\Thread');
    }

    /**
     * Participants relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('Modules\Message\Entities\Participant', 'thread_id', 'thread_id');
    }

}
