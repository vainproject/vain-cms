<div class="modal fade" id="modal-add-participant" tabindex="-1" role="dialog" aria-labelledby="addParticipantLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'message.message.store']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addParticipantLabel">@lang('message::message.send_message')</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        {!! Form::label('subject', trans('message::message.subject')) !!}
                        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                        <br/>

                        {!! Form::label('participants', trans('message::message.participants')) !!}
                        {!! Form::text('participants', null, ['class' => 'form-control']) !!}
                        <br/>

                        {!! Form::label('message', trans('message::message.message')) !!}
                        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Absenden', ['class' => 'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>