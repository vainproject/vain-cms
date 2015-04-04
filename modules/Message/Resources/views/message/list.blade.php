@extends('app')

@section('title')
    @lang('message::message.title.list')
@stop

@section('styles')
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojify.js/0.9.5/emojify.min.css" />
@stop

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-xs-3">--}}
                {{--{!! link_to_route('message.message.create', trans('message::message.new_message'), [], ['class' => 'btn btn-success']) !!}--}}
            {{--</div>--}}
            {{--<div class="col-xs-9">--}}
                {{--a--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">--}}

    <div class="container">
        <div class="row">
            @foreach ($errors->all() as $error)
                {!! var_dump($error); !!}
            @endforeach
            <div class="col-lg-3">
                <div class="btn-panel btn-panel-conversation">
                    {{--<a href="" class="btn  col-lg-6 send-message-btn " role="button"><i class="fa fa-search"></i> Search</a>--}}
                    <a href="{!! URL::route('message.message.create') !!}" class="btn  col-lg-6  send-message-btn pull-right" role="button">
                        <i class="fa fa-plus"></i> @lang('message::message.new_message')
                    </a>
                </div>
            </div>

            {{--<div class="col-lg-offset-1 col-lg-7">--}}
                {{--<div class="btn-panel btn-panel-msg">--}}

                    {{--<a href="" class="btn  col-lg-3  send-message-btn pull-right" role="button"><i class="fa fa-gears"></i> Settings</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="row">

            <div class="conversation-wrap col-lg-3">

                @if ($threads->count() > 0)
                    @foreach ($threads as $thread)
                        <div class="media conversation media-message-link {!! $thread->classStates($curThread) !!}">
                            <a href="{!! URL::route('message.message.show', $thread->id) !!}"></a>
                            <div class="pull-left">
                                <img class="media-object" alt="{{ $thread->lastmessage->user->name }}" style="width: 50px; height: 50px;" src="{!! $thread->avatar !!}">
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong>{!! $thread->participantsString(Auth::id(), ['name'], 30) !!}</strong>
                                </h5>
                                <small>{{ str_limit($thread->lastmessage->body, 30) }}</small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="media conversation">
                        <div class="media-body text-center">
                            <small>@lang('message::message.no_messages')</small>
                        </div>
                    </div>
                @endif

            </div>



            <div class="message-wrap col-lg-8">
                <div class="msg-wrap" id="msg-wrap">

                    @if ($curThread)
                        @foreach ($curThread->messages as $message)
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

                                    <small class="col-lg-10">{{ $message->body }}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                @if($curThread)
                    {!! Form::open(['method' => 'PUT', 'route' => ['message.message.update', $curThread->id]]) !!}
                        <div class="send-wrap ">
                            <textarea name="message" class="form-control send-message" rows="2" placeholder="@lang('message::message.write_a_reply')"></textarea>
                        </div>
                        <div class="btn-panel">
                            <a href="" class=" col-lg-3 btn   send-message-btn " role="button"><i class="fa fa-plus"></i> @lang('message::message.add_participant')</a>
                            {{--<a class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button"></a>--}}
                            <button type="submit" class="col-lg-4 text-right btn send-message-btn pull-right" role="button">
                                <i class="fa fa-envelope"></i> @lang('message::message.send_message')
                            </button>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var d = $('#msg-wrap');
            d.scrollTop(d.prop("scrollHeight"));

            emojify.setConfig({
                emoticons_enabled: true,
                people_enabled: true,
                nature_enabled: true,
                objects_enabled: true,
                places_enabled: true,
                symbols_enabled: true
            });
            emojify.run();
        });
    </script>
@stop
