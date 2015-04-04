<?php namespace Modules\Site\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Content;
use Modules\Site\Entities\Page;
use Modules\Site\Http\Requests\PageFormRequest;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;

class SiteController extends Controller {

    function __construct()
    {
        $this->beforeFilter('permission:site.page.show', ['only' => ['index', 'show']]);
        $this->beforeFilter('permission:site.page.create', ['only' => ['create', 'store']]);
        $this->beforeFilter('permission:site.page.edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('permission:site.page.destroy', ['only' => 'destroy']);
    }

    public function index()
    {
        $pages = Page::with('user')->paginate();

        return view('site::admin.pages.index')
            ->with('pages', $pages);
    }

    public function create()
    {
        $users = User::all()->lists('name', 'id');

        $roles = array_merge(
            [ null => trans('site::admin.pages.role') ],
            Role::all()->lists('display_name', 'name') );

        $locales = config('app.locales');

        return view('site::admin.role.none')
            ->with(['users' => $users, 'roles' => $roles, 'locales' => $locales]);
    }

    public function store(PageFormRequest $request)
    {
        $page = new Page($request->all());

        $creator = $request->user();
        $page->user()->associate($creator);
        $page->save();

        foreach (config('app.locales') as $locale => $name)
        {
            $content = (new Content())
                ->fillTranslated($locale, $request->all());

            $content->page()->associate($page);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        $page = Page::find($id);

        $users = User::all()->lists('name', 'id');

        $roles = array_merge(
            [ null => trans('site::admin.role.none') ],
            Role::all()->lists('display_name', 'name') );

        $locales = config('app.locales');

        return view('site::admin.pages.edit')
            ->with(['page' => $page, 'users' => $users, 'roles' => $roles, 'locales' => $locales]);
    }

    public function update(PageFormRequest $request, $id)
    {
        $page = Page::find($id);
        $page->fill($request->all());
        $page->save();

        foreach (config('app.locales') as $locale => $name)
        {
            $content = $page->contents()
                ->localeOrNew($locale)
                ->fillTranslated($locale, $request->all());

            $content->page()->associate($page);
            $content->save();
        }

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