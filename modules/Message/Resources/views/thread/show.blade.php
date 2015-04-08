@if (count($thread->messages) === 0)
    <p>No messages</p>
@else
    @foreach ($thread->messages as $message)
        {{-- Not happy with this :x --}}
        @if (!isset($lastDate) || $lastDate->format('Y-m-d') != $message->created_at->format('Y-m-d'))
            <div class="alert alert-info msg-date">
                @if ($message->created_at->format('Y-m-d') == Carbon\Carbon::now()->format('Y-m-d'))
                    <strong>@lang('message::message.today')</strong>
                @else
                    <strong>{{ $message->created_at->format('d.m.Y') }}</strong>
                @endif
            </div>
        @endif
        <?php $lastDate = $message->created_at; ?>

        <div class="media msg">
            <a class="pull-left" href="#">
                <img class="media-object" alt="{{ $message->user->name }}" style="width: 32px; height: 32px;" src="{!! $message->user->avatar !!}">
            </a>
            <div class="media-body">
                <small class="pull-right time" title="{{ $message->created_at }}"><i class="fa fa-clock-o"></i> {{ $message->created_at->diffForHumans() }}</small>
                <h5 class="media-heading">
                    {!! link_to_route('user.profile', $message->user->name, $message->user->id) !!}
                </h5>

                <small data-emojify>{!! strip_tags( nl2br( $message->body ), '<br>' ) !!}</small>
            </div>
        </div>
    @endforeach
@endif