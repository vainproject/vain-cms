<?php namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostContent;
use Modules\Blog\Http\Requests\PostFormRequest;

class PostController extends Controller
{

    function __construct()
    {
        $this->beforeFilter('permission:blog.post.show', ['only' => ['index']]);
        $this->beforeFilter('permission:blog.post.create', ['only' => ['create', 'store']]);
        $this->beforeFilter('permission:blog.post.edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('permission:blog.post.destroy', ['only' => 'destroy']);
    }

    public function index()
    {
        /** @var Post $posts */
        $posts = Post::with('user')->paginate();

        return view('blog::admin.posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        $locales = config('app.locales');
        $categories = Category::all()->lists('content.name', 'id');

        return view('blog::admin.posts.create', ['locales' => $locales, 'categories' => $categories]);
    }

    public function store(PostFormRequest $request)
    {
        $post = new Post($request->all());

        $post->user()->associate($request->user());
        $post->save();

        foreach (config('app.locales') as $locale => $name)
        {
            $content = (new PostContent())
                ->fillTranslated($locale, $request->all());

            $content->post()->associate($post);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $locales = config('app.locales');
        $categories = Category::all()->lists('content.name', 'id');

        return view('blog::admin.posts.edit', ['post' => $post, 'locales' => $locales, 'categories' => $categories]);
    }

    public function update(PostFormRequest $request, $id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $post->fill($request->all());
        $post->save();

        foreach (config('app.locales') as $locale => $name)
        {
            $content = $post->contents()
                ->localeOrNew($locale)
                ->fillTranslated($locale, $request->all());

            $content->post()->associate($post);
            $content->save();
        }

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        $post->delete();

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

        return redirect()->route('blog.admin.posts.index');
    }
}