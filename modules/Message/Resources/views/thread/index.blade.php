{{-- ajax loadable content --}}

@if ($threads->count() > 0)
    @foreach ($threads as $thread)
        <div class="media conversation media-message-link @if($thread->unreadForUser()) media-message-unread @endif">
            <a href="#" data-thread="{{ $thread->id }}"></a>
            <div class="pull-left">
                <img class="media-object" alt="{{ $thread->lastmessage->user->name }}" style="width: 50px; height: 50px;" src="{!! $thread->avatar !!}">
            </div>
            <div class="media-body">
                <h5 class="media-heading"><strong>{!! $thread->participantString(40) !!}</strong></h5>
                <small data-emojify>{{ $thread->shortbody }}</small>
            </div>
            <small class="pull-right time" title="{{ $thread->lastmessage->created_at }}"><i class="fa fa-clock-o"></i> {{ $thread->lastmessage->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
@else
    <div class="media conversation">
        <div class="media-body text-center">
            <small>@lang('message::message.no_messages')</small>
        </div>
    </div>
@endif