<?php namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Page;

class AdminController extends Controller {


    public function getIndex()
    {
        $pages = Page::with('user')->paginate();

        return view('site::admin.index')
            ->with('pages', $pages);
    }

    public function getCreate()
    {

    }

    public function postCreate()
    {

    }

    public function getPage(Request $request, $id)
    {

    }

    public function postPage()
    {

    }

    public function deletePage($id)
    {
        Page::find($id)->delete();
    }
}