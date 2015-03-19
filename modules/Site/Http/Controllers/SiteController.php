<?php namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Site\Entities\Page;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteController extends Controller {

    public function getPage($slug)
    {
        $page = Page::published()
            ->where('slug', $slug)
            ->first();

        if ($page === null)
        {
            throw new NotFoundHttpException('page with slug \''. $slug .'\' not found');
        }

        return view('site::page')->with('page', $page);
    }
}