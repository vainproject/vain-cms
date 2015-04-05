<?php namespace Modules\Blog\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentFormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller {

    function __construct()
    {
        $this->beforeFilter('permission:blog.post.show', ['only' => ['index', 'show']]);
        $this->beforeFilter('permission:blog.post.create', ['only' => ['create', 'store']]);
        $this->beforeFilter('permission:blog.post.edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('permission:blog.post.destroy', ['only' => 'destroy']);
    }

	public function index()
	{
        $posts = Post::with('user', 'category', 'comments')->published()->paginate(config('blog.posts_per_page'));

		return view('blog::index')->with('posts', $posts);
	}

    public function show($slug)
    {
        $post = Post::published()
            ->with('user', 'category')
            ->where('slug', $slug)
            ->first();

        if ($post === null) {
            throw new NotFoundHttpException('post with slug \'' . $slug . '\' not found');
        }

        return view('blog::post')->with('post', $post);
    }


}