<?php

namespace Modules\Site\Http\Controllers;

use Modules\Site\Entities\Page;
use Vain\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * @param $slug
     *
     * @return $this
     */
    public function show($slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->first();

        if ($page === null) {
            app()->abort(404, 'page with slug \''.$slug.'\' not found');
        }

        $this->authorize('show', $page);

        return view('site::page')->with('page', $page);
    }
}
