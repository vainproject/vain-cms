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
     * Render thread overview and open most recent thread
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var Thread[] $threads */
        $threads = Thread::withComponents()
            ->forUser(Auth::id())
            ->get();

        /** @var Thread $curThread */
        $curThread = $threads->first();
        if ($curThread)
            $curThread->markAsRead(Auth::id());

        return view('message::message.list', compact('threads', 'curThread'));
    }

    /**
     * Render message create form
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('message::message.create');
    }

    /**
     * Store new thread
     * @param StoreMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMessageRequest $request)
    {
        // ToDo: split participants
        $user = User::whereName($request->input('participants'))->first();
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

        return redirect()->route('message.message.index')
            ->with('success', trans('message::message.thread_created'));
    }

    /**
     * Render specific message thread
     * @param Thread $thread
     * @return \Illuminate\View\View
     */
    public function show(Thread $curThread)
    {
        /** @var Thread[] $threads */
        $threads = Thread::withComponents()
            ->forUser(Auth::id())
            ->get();

        $curThread->markAsRead(Auth::id());

        return view('message::message.list', compact('threads', 'curThread'));
    }

    /**
     * Store new message for existing thread
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

        // ToDo: cleaner check
        if (!$participant)
            return redirect()->route('message.message.index')
                ->withErrors(trans('message::message.not_found'));

        $participant->last_read = new Carbon;
        $participant->save();

        return redirect()->route('message.message.index')
            ->with('success', trans('message::message.message_added'));
    }

}
