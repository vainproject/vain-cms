<?php namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Page;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller {


    public function getIndex()
    {
        $pages = Page::paginate();

        return view('site::admin.index')
            ->with('pages', $pages);
    }

    public function getAdd()
    {

    }

    public function postAdd()
    {

    }

    public function getPage(Request $request, $id)
    {

    }

    public function postPage()
    {

    }
}