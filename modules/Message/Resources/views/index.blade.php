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
            @if(isset($curThread) && $curThread)
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
                {{-- ajax loaded content --}}
            </div>

            <div class="message-wrap col-lg-9">
                <div class="msg-wrap" id="msg-wrap">
                    {{-- ajax loaded content --}}
                </div>

                @if(isset($curThread) && $curThread)
                    {!! Form::open(['method' => 'PUT', 'route' => ['message.message.update', $curThread->id]]) !!}
                        <div class="send-wrap ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <textarea type="text" name="message" class="form-control send-message" placeholder="@lang('message::message.write_a_reply')" rows="2" data-expand data-expand-rows-max="7" data-emoji-typehint></textarea>
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
    {{--@include('message::message.create')--}}

    {{-- Add participant modal --}}
    {{--@include('message::message.participant')--}}
@stop