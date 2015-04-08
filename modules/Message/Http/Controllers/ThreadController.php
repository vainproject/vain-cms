<?php namespace Modules\Message\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Message\Entities\Message;
use Modules\Message\Entities\Participant;
use Modules\Message\Entities\Thread;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Message\Http\Requests\StoreMessageRequest;
use Modules\Message\Http\Requests\UpdateMessageRequest;
use Modules\User\Entities\User;

class ThreadController extends Controller
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

        return view('message::thread.index', compact('threads'));
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
            'thread_id'    => $thread->id,
            'user_id'      => Auth::id(),
            'last_read'    => Carbon::now(),
            'last_message' => Carbon::now(),
        ]);

        $thread->addParticipants([$user->id]);

        return redirect()->route('message.message.index')
            ->with('success', trans('message::message.thread_created'));
    }

    /**
     * Render specific message thread
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $thread = Thread::find($id);

        // this is the most query-saving solution
        // we already have our desired thread with relations in the collection
        // by doing this we don't have to load them again
//        $curThread = $threads->filter(function($item) use($thread) {
//            return $item->id == $thread->id;
//        })->first();

//        $curThread->markAsRead(Auth::id());
        $thread->markAsRead($request->user()->id);

        return view('message::thread.show', compact('thread'));
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

        $participant->last_read = Carbon::now();
        $participant->last_message = Carbon::now();
        $participant->save();

        return redirect()->route('message.message.index')
            ->with('success', trans('message::message.message_added'));
    }

}
