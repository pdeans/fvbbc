<?php


View::composer('layouts.base', function($view)
{
    $view->recentPosts = Post::orderBy('id','desc')->take(5)->get();
});
