<?php namespace Modules\Blog\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Blog\Entities\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller {

	public function getIndex()
	{
        $posts = Post::published()->paginate(config('blog.posts_per_page'));

		return View::make('blog::index')->with('posts', $posts);
	}

    public function getPost($slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->first();

        if ($post === null) {
            throw new NotFoundHttpException('post with slug \'' . $slug . '\' not found');
        }

        return view('blog::post')->with('post', $post);
    }
}