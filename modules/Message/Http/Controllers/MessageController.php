<?php namespace Modules\Message\Http\Controllers;

use Carbon\Carbon;
use Modules\Message\Entities\Message;
use Modules\Message\Entities\Participant;
use Modules\Message\Entities\Thread;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Message\Http\Requests\StoreMessageRequest;
use Modules\Message\Http\Requests\UpdateMessageRequest;
use Modules\User\Entities\User;

class MessageController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var Thread[] $threads */
        $threads = Thread::with(array(
            'participants' => function ($query) {
                $query->orderBy('last_read', 'desc');
            },
            'participants.user',
            'messages',
            'messages.user',
            'latestMessage',
            'latestMessage.user',
        ))
            ->forUser(Auth::id());

        /** @var Thread $curThread */
        $curThread = $threads->first();
        if ($curThread)
            $curThread->markAsRead(Auth::id());

        return view('message::message.list', compact('threads', 'curThread'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('message::message.create');
    }

    /**
     * @param StoreMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMessageRequest $request)
    {
        // ToDo: split participants
        $user = User::where('name', $request->input('participants'))->first();
        if (is_null($user))
            return redirect()->back();

        /** @var Thread $thread */
        $thread = Thread::create([
            'subject' => $request->input('subject'),
        ]);

        Message::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::id(),
            'body'      => $request->input('message'),
        ]);

        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::id(),
            'last_read' => new Carbon,
        ]);

        $thread->addParticipants([$user->id]);

        return redirect()->route('message.message.index'); // ToDo: flash success message
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\View\View
     */
    public function show(Thread $curThread)
    {
        /** @var Thread[] $threads */
        $threads = Thread::with(array(
            'participants' => function ($query) {
                $query->orderBy('last_read', 'desc');
            },
            'participants.user',
            'messages',
            'messages.user',
            'latestMessage',
            'latestMessage.user',
        ))
            ->forUser(Auth::id());

        $curThread->markAsRead(Auth::id());

        return view('message::message.list', compact('threads', 'curThread'));
    }

    /**
     * @param UpdateMessageRequest $request
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMessageRequest $request, Thread $thread)
    {
        $thread->activateAllParticipants();

        Message::create([
            'thread_id' => $thread->id,
            'user_id'   => Auth::id(),
            'body'      => $request->input('message'),
        ]);

        $participant = Participant::where('thread_id', $thread->id)
            ->where('user_id', Auth::id())
            ->first();
//        $participant = Participant::firstOrCreate([
//            'thread_id' => $thread->id,
//            'user_id'   => Auth::id(),
//        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        return redirect()->route('message.message.index');
//        return redirect()->route('message.message.show', $thread->id); // ToDo: flash success message
    }

}
