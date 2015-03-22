<?php namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Page;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteController extends Controller {

    /**
     * @param Request $request
     * @param $slug
     * @return $this
     */
    public function getPage(Request $request, $slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->first();

        if ($page === null)
        {
            throw new NotFoundHttpException('page with slug \''. $slug .'\' not found');
        }

        if (!empty($page->role) && !$request->getUser()->hasRole($page->role))
        {
            throw new NotFoundHttpException('no permission to view page with slug \''. $slug .'\'');
        }

        return view('site::page')->with('page', $page);
    }
}