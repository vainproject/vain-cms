<?php namespace Modules\Site\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Page;
use Modules\Site\Http\Requests\PageFormRequest;

class SiteController extends Controller {

    public function index()
    {
        $pages = Page::with('user')->paginate();

        return view('site::admin.pages.index')
            ->with('pages', $pages);
    }

    public function create()
    {
        return view('site::admin.pages.create');
    }

    public function store(PageFormRequest $request)
    {
        Page::create($request->all());

        return $this->createDefaultResponse($request);
    }

    public function show($id)
    {
        $page = Page::find($id);

        return view('site::admin.pages.edit')
            ->with('page', $page);
    }

    public function update(PageFormRequest $request, $id)
    {
        $page = Page::find($id);

        $page->fill($request->all());
        $page->save();

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
        Page::find($id)->delete();

        return $this->createDefaultResponse($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse($request)
    {
        if ($request->ajax()) {
            // very default response, we basicly just need the response code
            return response('', 200);
        }

        return redirect()->route('site.admin.sites.index');
    }
}