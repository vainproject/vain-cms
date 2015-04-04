<?php namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentFormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->beforeFilter('permission:blog.comment.show', ['only' => ['index', 'show']]);
        $this->beforeFilter('permission:blog.post.create', ['only' => ['create', 'store']]);
        $this->beforeFilter('permission:blog.post.edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('permission:blog.post.destroy', ['only' => 'destroy']);
    }

    public function create(CommentFormRequest $request, $postId)
    {
        $post = Post::published()->findOrFail($postId);

        new Comment($request->all());

        $comment = new Comment($request->all());

        $comment->user()->associate($request->user());
        $comment->post()->associate($post);
        $comment->bluepost = $request->user()->can('blog.comment.bluepost');

        $comment->save();

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        $comment->delete();

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

        return redirect()->route('site.blog.index');
    }
}