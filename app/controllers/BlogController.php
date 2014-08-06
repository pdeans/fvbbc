<?php

class BlogController extends BaseController {

    /**
     * Blog Page Constructor
     */
    public function __construct()
    {
        # Prevent re-login
        $this->beforeFilter('guest',['only' => ['user-sign-in']]);
        $this->beforeFilter('auth', ['only' => ['user-sign-out']]);
    }

    /**
     * Blog Page (GET)
     *
     * @return View
     */
    public function getBlog()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        $posts->getEnvironment()->setViewName('pagination.slider');

        return View::make('blog.blog_main', compact('posts'));
    }

    /**
     * Blog Page - Search (GET)
     *
     * @return View
     */
    public function getSearch()
    {
        $notFound = false;
        $searchTerm = Input::get('s');
        $posts = Post::whereRaw('match(title,content) against(? in boolean mode)',[$searchTerm])
                     ->paginate(10);
        $posts->getEnvironment()->setViewName('pagination.slider');
        $posts->appends(['s' => $searchTerm]);
        $search_title = 'Results for: ' . $searchTerm;

        if ($posts->isEmpty())
        {
            $notFound = true;
        }

        return View::make('blog.blog_search', compact('search_title', 'notFound', 'posts'));
    }

}
