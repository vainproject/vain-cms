<?php namespace Modules\Message\Entities;

use Cmgmyr\Messenger\Models\Participant as MessengerParticipant;

/**
 * Modules\Message\Entities\Participant
 *
 * @property integer $id
 * @property integer $thread_id
 * @property integer $user_id
 * @property \Carbon\Carbon $last_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Modules\Message\Entities\Thread $thread
 * @property-read \Config::get('messenger.user_model') $user
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereLastRead($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Participant whereDeletedAt($value)
 */
class Participant extends MessengerParticipant {

    protected $table = 'message_participants';

    /**
     * Thread relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

}
