<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('site::admin.abort')"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">@lang('site::admin.confirm')</h4>
            </div>
            <div class="modal-body">
                @lang('site::admin.delete')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site::admin.abort')</button>
                <button type="button" class="btn btn-danger" data-positive="modal">@lang('site::admin.confirm')</button>
            </div>
        </div>
    </div>
</div>