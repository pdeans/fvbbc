<?php

class PostController extends BaseController {


    public function __construct()
    {
       $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /** ------------------------------------------
     *  PostController - GET functions
     *  ------------------------------------------
     */

    /**
     * Show list of posts (GET)
     *
     * @return View
     */
    public function listPost()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);

        return View::make('admin.dash', compact('posts'));
    }

    /**
     * Show posts (GET)
     *
     * @return View
     */
    public function showPost(Post $post)
    {
        $comments = $post->comments()->where('approved', '=', 1)->orderBy('id', 'desc')->get();

        return View::make('blog.blog_post', compact('post', 'comments'));
    }

    /**
     * Create new blog post (GET)
     *
     * @return View
     */
    public function createPost()
    {
        return View::make('blog.new_post');
    }

    /**
     * Edit blog post (GET)
     *
     * @param  Post $post
     * @return View
     */
    public function editPost(Post $post)
    {
        return View::make('blog.edit_post', compact('post'));
    }

    /**
     * Delete blog post (GET)
     *
     * @param  Post $post
     * @return Redirect
     */
    public function deletePost(Post $post)
    {
        $post->delete();

        return Redirect::route('admin.dash')->with('message', 'Post deleted.');
    }

    /** ------------------------------------------
     *  PostController - POST functions
     *  ------------------------------------------
     */

    /**
     * Save blog post
     *
     * @return Redirect
     */
    public function savePost()
    {
        $post = [
            'title'     => Input::get('title'),
            'content'   => Input::get('content'),
        ];
        $rules = [
            'title'     => 'required|min:3|max:25',
            'content'   => 'required|min:3',
        ];

        $valid = Validator::make($post, $rules);

        # If blog post validation passes
        if ($valid->passes())
        {
            $post = new Post($post);
            $post->posted_by = Auth::user()->username;
            $post->comment_count = 0;
            $post->read_more = (strlen($post->content) > 750) ? substr($post->content, 0, 750) : $post->content;
            $post->save();

            return Redirect::route('blog')->with('message', 'Blog post created successfully.');
        }
        else
            return Redirect::back()->withErrors($valid)->withInput();
    }

    /**
     * Update blog post
     *
     * @param  Post $post
     * @return Redirect
     */
    public function updatePost(Post $post)
    {
        $data = [
            'title' => Input::get('title'),
            'content' => Input::get('content'),
        ];
        $rules = [
            'title' => 'required|min:3|max:25',
            'content' => 'required|min:3',
        ];

        $valid = Validator::make($data, $rules);

        # If blog update post validation passes
        if ($valid->passes())
        {
            $post->title = $data['title'];
            $post->content = $data['content'];
            $post->read_more = (strlen($post->content) > 120) ? substr($post->content, 0, 120) : $post->content;

            # Avoid resubmission of same content
            if(count($post->getDirty()) > 0)
            {
                $post->save();
                return Redirect::back()->with('message', 'Post update successful.');
            }
            else
                return Redirect::back()->with('message','Error: Empty post.');
        }
        else
            return Redirect::back()->withErrors($valid)->withInput();
    }

}
