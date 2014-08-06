<?php

/**
 *  ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('post', 'Post');
Route::model('comment', 'Comment');

/**
 *  -----------------------------------------
 *  Admin Routes
 *  -----------------------------------------
 */

# GET routes
Route::get('/admin/dashboard', array(
    'as'    => 'admin-dash',
    'uses'  => 'AdminController@showDash'
));
Route::get('/admin/dashboard', array(
    'as'    => 'blog-post-list',
    'uses'  => 'PostController@listPost'
));
Route::get('/admin/dashboard', array(
    'as'    => 'blog-comment-list',
    'uses'  => 'CommentController@listComment'
));
Route::get('/blog/{post}/edit', array(
    'as'    => 'blog-post-edit',
    'uses'  => 'PostController@editPost'
));
Route::get('/blog/{post}/delete', array(
    'as'    => 'blog-post-delete',
    'uses'  => 'PostController@deletePost'
));
Route::get('/blog/{comment}/delete', array(
    'as'    => 'blog-comment-delete',
    'uses'  => 'CommentController@deleteComment'
));

# POST routes
Route::post('/blog/{post}/update', array(
    'as'    => 'blog-post-update',
    'uses'  => 'PostController@updatePost'
));
Route::post('/blog/{comment}/update', array(
    'as'    => 'blog-comment-update',
    'uses'  => 'CommentController@updateComment'
));


/**
 *  ------------------------------------------
 *  User Accounts Routes (User Controller)
 *  ------------------------------------------
 */

# User Register (GET)
Route::get('/user/register', array(
    'as'    => 'user-create',
    'uses'  => 'UsersController@getCreate'
));

# User Register (POST)
Route::post('/user/register', array(
    'as'    => 'user-create-post',
    'uses'  => 'UsersController@postCreate'
));

# User Activate Account (GET)
Route::get('/user/activate/{code}', array(
    'as'    => 'user-activate',
    'uses'  => 'UsersController@getActivate'
));

# User Log in (GET)
Route::get('/user/sign-in', array(
    'as'    => 'user-sign-in',
    'uses'  => 'UsersController@getSignIn'
));

# Log in (POST)
Route::post('/user/sign-in', array(
    'as'    => 'user-sign-in-post',
    'uses'  => 'UsersController@postSignIn'
));

# User Edit Profile (POST)
Route::post('user/{user}/edit', 'UsersController@postEdit');

# Log Out (GET)
Route::get('/user/sign-out', array(
    'as'    => 'user-sign-out',
    'uses'  => 'UsersController@getSignOut'
));

# User Forgot password (GET)
Route::get('/user/forgot', array(
    'as'    => 'user-forgot-password',
    'uses'  => 'UsersController@getForgotPassword'
));

# User Forgot password (POST)
Route::post('/user/forgot', array(
    'as'    => 'user-forgot-password-post',
    'uses'  => 'UsersController@postForgotPassword'
));

# User Recover password (GET)
Route::get('/user/recover/{code}', array(
    'as'    => 'user-recover',
    'uses'  => 'UsersController@getRecover'
));

# User RESTful Routes
Route::controller('user', 'UsersController');


/**
 *  ------------------------------------------
 *  Blog Routes
 *  ------------------------------------------
 */

# Blog Mainpage - BlogController (GET)
Route::get('/blog', array(
    'as'    => 'blog',
    'uses'  => 'BlogController@getBlog'
));

# Search Blog Posts - BlogController (GET)
Route::get('/blog/search', array(
    'as'    => 'blog-search',
    'uses'  => 'BlogController@getSearch'
));

# Create New Blog Post - PostController (GET)
Route::get('/blog/create', array(
    'as'    => 'blog-post-create',
    'uses'  => 'PostController@createPost'
));

# Show Blog Post - PostController (GET)
Route::get('/blog/{post}', array(
    'as'    => 'blog-post',
    'uses'  => 'PostController@showPost'
));

# Blog Post Comment - CommentController (GET)
Route::post('/blog/{post}/comment', array(
    'as'    => 'blog-comment',
    'uses'  => 'CommentController@newComment'
));

# Show Blog Post Comment (GET)
Route::get('/blog/{comment}', array(
    'as'    => 'blog-comment-show',
    'uses'  => 'CommentController@showComment'
));

# Save New Blog Post - PostController (POST)
Route::post('/blog/create', array(
    'as'    => 'blog-post-save',
    'uses'  => 'PostController@savePost'
));


/** ------------------------------------------
 *  Page Routes (Home Controller)
 *  ------------------------------------------
 */

# Homepage
Route::get('/', array(
    'as'    => 'home',
    'uses'  => 'HomeController@home'
));

# About Page
Route::get('/about', array(
    'as'    => 'about',
    'uses'  => 'HomeController@about'
));

# Contact Page
Route::get('/contact', array(
    'as'    => 'contact',
    'uses'  => 'HomeController@contact'
));

# Test Page
Route::get('/testpage', array(
    'as'    => 'testpage',
    'uses'  => 'HomeController@testpage'
));

/**
 *  ------------------------------------------
 *  Page Routes (SidebarController)
 *  ------------------------------------------
 */

# Training Tools (post)
Route::post('/extras/tools', array(
    'as'    => 'tools-post',
    'uses'  => 'SidebarController@postTools'
));

# Sidebar RESTful Routes
Route::controller('extras', 'SidebarController');

