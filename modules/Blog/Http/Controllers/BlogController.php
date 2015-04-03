<?php namespace Modules\Blog\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentFormRequest;
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

    public function postComment(CommentFormRequest $request, $postId)
    {
        $post = Post::published()->findOrFail($postId);

        $comment = Comment::create([
            'text' => $request->get('text'),
            'is_bluepost' => false // to be implemented
        ]);

        Auth::user()->attach($comment);
        $post->attach($comment);

        return $this->createDefaultResponse($request);
    }


    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse($request)
    {
        if ($request->ajax()) {
            return response('', 200);
        }

        return redirect()->route('site.blog.index');
    }
}