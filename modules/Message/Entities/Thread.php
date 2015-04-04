<?php namespace Modules\Message\Entities;

use Cmgmyr\Messenger\Models\Thread as MessengerThread;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * Modules\Message\Entities\Thread
 *
 * @property integer $id 
 * @property string $subject 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $deleted_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Message\Entities\Message[] $messages 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Message\Entities\Participant[] $participants 
 * @property-read \Modules\Message\Entities\Message')->latest()->limit(1 $latestMessage 
 * @property-read mixed $avatar 
 * @property-read mixed $latest_message 
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Thread whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Thread whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Message\Entities\Thread whereDeletedAt($value)
 * @method static \Modules\Message\Entities\Thread forUser($userId)
 * @method static \Modules\Message\Entities\Thread withComponents()
 * @method static \Cmgmyr\Messenger\Models\Thread forUserWithNewMessages($userId)
 */
class Thread extends MessengerThread {

    /**
     * Messages relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('Modules\Message\Entities\Message');
    }

    /**
     * Participants relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('Modules\Message\Entities\Participant');
    }

    /**
     * Last message relationship
     * @return mixed
     */
    public function latestMessage()
    {
        return $this->hasOne('Modules\Message\Entities\Message')->latest()->limit(1);
    }

    /**
     * Returns threads that the user is associated with
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeForUser($query, $userId)
    {
        return $query->join('participants', 'threads.id', '=', 'participants.thread_id')
            ->where('participants.user_id', $userId)
            ->where('participants.deleted_at', null)
            ->select('threads.*')
            ->latest('updated_at');
    }

    /**
     * Loads various needed components
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeWithComponents($query)
    {
        return $query->with(array(
            'participants' => function ($query) {
                $query->orderBy('last_read', 'desc');
            },
            'participants.user',
            'messages',
            'messages.user',
            'latestMessage',
            'latestMessage.user',
        ));
    }

    /**
     * Get fitting avatar for conversation (avoiding additional db queries)
     * @return mixed
     */
    public function getAvatarAttribute()
    {
        if ($this->participants->count() == 1)
            return $this->participants->first()->avatar;

        $participants = $this->participants->sortBy(function($participant) {
            return $participant->last_read;
        });

        foreach ($participants as $participant)
            if ($participant->user_id != Auth::id())
                return $participant->user->avatar;

        return Auth::user()->avatar;
    }

    /**
     * Generates a string of participant information
     * @param null $userId
     * @param array $columns
     * @return string
     */
    public function participantsString($userId=null, $columns=['name'], $maxLength = false)
    {
        $participantNames = [];
        $length = 0;
        foreach ($this->participants as $participant) {
            if ($participant->user_id == $userId)
                continue;

            if ($maxLength && (strlen($participant->name + $length)) > ($maxLength - 5)) {
                $participantNames[] = "...";
                break;
            }

            $participantNames[] = $participant->user->name;
        }

        return implode(', ', $participantNames);
    }

}
