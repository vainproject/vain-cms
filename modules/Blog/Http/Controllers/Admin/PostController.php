<?php namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Site\Http\Requests\PageFormRequest;

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

    public function edit($id)
    {
        /** @var Post $post */
        $post = Post::find($id);

        return view('blog::admin.posts.edit', ['post' => $post]);
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