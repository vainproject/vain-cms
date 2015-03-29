<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('user::permission.action.abort')"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">@lang('user::permission.action.confirm')</h4>
            </div>
            <div class="modal-body">
                @lang('user::permission.delete.message')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('user::permission.action.abort')</button>
                <button type="button" class="btn btn-danger" data-positive="modal">@lang('user::permission.action.confirm')</button>
            </div>
        </div>
    </div>
</div>