<?php namespace Modules\Message\Entities;

use Cmgmyr\Messenger\Models\Message as MessengerMessage;
use Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;
use Emojione\Emojione;

/**
 * Modules\Message\Entities\Message
 *
 * @property integer $id 
 * @property integer $thread_id 
 * @property integer $user_id 
 * @property string $body 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property-read \Modules\Message\Entities\Thread $thread 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Message\Entities\Participant[] $participants 
 * @property-read \Config::get('messenger.user_model') $user 
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Message whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Message whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Message whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Message whereUpdatedAt($value)
 */
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
