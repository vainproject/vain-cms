<?php namespace Modules\Message\Entities;

use Cmgmyr\Messenger\Models\Participant as MessengerParticipant;

class Participant extends MessengerParticipant {

    /**
     * Thread relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('Modules\Message\Entities\Thread');
    }

}
