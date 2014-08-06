<?php


class CommentController extends BaseController {


    public function __construct()
    {
       $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * ------------------------------------------
     *  CommentController - GET functions
     * ------------------------------------------
     */
    public function listComment()
    {
        $comments = Comment::orderBy('id','desc')->paginate(20);

        return View::make('admin.dash', compact('comments'));
    }

    public function newComment(Post $post)
    {
        $comment = array(
            'comment' => Input::get('comment')
        );

        $rules = array(
            'comment' => 'required|min:3'
        );

        $valid = Validator::make($comment, $rules);

        if($valid->passes())
        {
            $comment = new Comment($comment);
            $comment->approved = 1;
            $comment->commenter = Auth::user()->username;
            $post->comments()->save($comment);
            $post->increment('comment_count');

            return Redirect::to(URL::previous())
                    ->with('message','Comment created successfully.');
        }
        else {
            return Redirect::to(URL::previous().'#comment-form')
                    ->withErrors($valid)->withInput();
        }
    }

    public function showComment(Comment $comment)
    {
        if(Request::ajax())
        {
            return View::make('comments.show', compact('comment'));
        }

        # else{} - Handle non-ajax calls here
    }

    public function deleteComment(Comment $comment)
    {
        $post = $comment->post;
        $status = $comment->approved;
        $comment->delete();
        ($status === 1) ? $post->decrement('comment_count') : '';

        return Redirect::back()
                ->with('message','Comment deleted.');
    }


    /**
     * ------------------------------------------
     *  CommentController - POST functions
     * ------------------------------------------
     */
    public function updateComment(Comment $comment)
    {
        $comment->approved = Input::get('status');
        $comment->save();

        $comment->post->comment_count = Comment::where('post_id', '=', $comment->post->id)
                                                ->where('approved', '=', 1)->count();
        $comment->post->save();

        return Redirect::back()
                ->with('message','Comment '. (($comment->approved === 1) ? 'approved.' : 'not approved.'));
    }
}
