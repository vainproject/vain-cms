<?php namespace Vain\Presenters;

use Illuminate\Pagination\BootstrapThreePresenter;

class AdminLtePresenter extends BootstrapThreePresenter
{
    /**
     * @return string
     */
    public function render()
    {
        if ($this->hasPages())
        {
            return sprintf(
                '<ul class="pagination pagination-sm no-margin">%s %s %s</ul>',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }
        return '';
    }
}