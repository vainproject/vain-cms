@if ($items->hasPages())
    <div class="box-footer">
        <span class="pull-right">
            {!! $items->render(new Vain\Presenters\Pagination\BackendPresenter($items)) !!}
        </span>
        <div class="text-muted">
            @lang('pagination.text', ['first' => $items->firstItem(), 'last' => $items->lastItem(), 'total' => $items->total() ])
        </div>
        <div class="clearfix"></div>
    </div>
@endif