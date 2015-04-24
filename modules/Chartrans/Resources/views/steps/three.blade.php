@extends('app')

@section('title')
    @lang('chartrans::chartrans.title.index')
@stop

@section('content')

    <div class="container">

        @include('chartrans::steps.stepbar')

        {!! Form::open(['route' => 'chartrans.step.three.store']) !!}
        <div class="chartrans-content-body">

            <h3 class="col-sm-12">@lang('chartrans::chartrans.step.three.caption')</h3>


            <div class="col-sm-12">
                <a href="{{ route('chartrans.step.two.show') }}"
                   class="btn btn-default pull-left">@lang('chartrans::chartrans.step.button.backwards')</a>
                {!! Form::submit(trans('chartrans::chartrans.step.button.forward'), ['class' => 'btn btn-success pull-right']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop