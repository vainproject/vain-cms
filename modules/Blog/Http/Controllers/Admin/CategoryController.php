<?php namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\CategoryContent;
use Modules\Blog\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:blog.category.show', ['only' => ['index']]);
        $this->middleware('permission:blog.category.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blog.category.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blog.category.destroy', ['only' => 'destroy']);
    }

    public function index()
    {
        /** @var Category $categories */
        $categories = Category::with('posts')->paginate();

        return view('blog::admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        $locales = config('app.locales');
        $categories = Category::all()->lists('content.name', 'id')->all();

        return view('blog::admin.categories.create', ['locales' => $locales, 'categories' => $categories]);
    }

    public function store(CategoryFormRequest $request)
    {
        /** @var Category $category */
        $category = Category::create($request->all());

        foreach (config('app.locales') as $locale => $name)
        {
            $content = (new CategoryContent())
                ->fillTranslated($locale, $request->all());

            $content->category()->associate($category);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        /** @var Category $category */
        $category = Category::find($id);
        $locales = config('app.locales');

        return view('blog::admin.categories.edit', ['category' => $category, 'locales' => $locales]);
    }

    public function update(CategoryFormRequest $request, $id)
    {
        /** @var Category $category */
        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();

        foreach (config('app.locales') as $locale => $name)
        {
            $content = $category->contents()
                ->localeOrNew($locale)
                ->fillTranslated($locale, $request->all());

            $content->category()->associate($category);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
        /** @var Category $category */
        $category = Category::find($id);

        $category->delete();

        return $this->createDefaultResponse($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse($request)
    {
        if ($request->ajax()) {
            return response('', 200);
        }

        return redirect()->route('blog.admin.categories.index');
    }
}