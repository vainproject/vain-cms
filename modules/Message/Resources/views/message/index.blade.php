@extends('app')

@section('title')
    @lang('message::message.title.list')
@stop

@section('content')
    <div class="container">

        <nav class="navbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#" data-target="#modal-send-message" class="send-message-btn" role="button" data-toggle="modal">
                        <i class="fa fa-plus"></i> @lang('message::message.new_message')
                    </a>
                </li>
            </ul>
            @if($curThread)
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" data-target="#modal-add-participant" class="add-participant-btn" role="button" data-toggle="modal">
                            <span class="fa fa-plus"></span> @lang('message::message.add_participant')
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            {{ $curThread->participantString(80) }}
                            <i class="fa fa-user"></i>
                            {{ $curThread->participants->count() }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-large scrollable-menu">
                            @foreach ($curThread->participants as $participant)
                                <li>
                                    <a href="{{ route('user.profile', $participant->user_id) }}">
                                        @userstate($participant->user) {{ $participant->user->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            @endif
        </nav>

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
                                <h5 class="media-heading"><strong>{!! $thread->participantString(40) !!}</strong></h5>
                                <small class="emojimessage">{{ $thread->shortbody }}</small>
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
            </div>

            <div class="message-wrap col-lg-9">
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

                                    <small class="emojimessage">{{ $message->body }}</small>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if($curThread)
                    {!! Form::open(['method' => 'PUT', 'route' => ['message.message.update', $curThread->id]]) !!}
                        <div class="send-wrap ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <textarea type="text" name="message" class="form-control send-message" placeholder="@lang('message::message.write_a_reply')" data-autocomplete-emoji></textarea>
                                        <span class="input-group-addon">
                                            <button type="submit" class="btn btn-default" role="button">@lang('message::message.send_message')</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>

    {{-- New message modal --}}
    @include('message::message.create')

    {{-- Add participant modal --}}
    @include('message::message.participant')
@stop
