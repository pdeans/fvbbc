@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/blog.css') }}
@stop

@section('content')

    <div class="main-wrap blog-post">
        <h2>The <span class="fvbbc">&#35;FVBBC</span> Blog</h2>

        <div class="blog-header">
            <span class="back-link">
                <a href="{{{ URL::route('blog') }}}">Back</a>
            </span>

            <span class="post-create">
                @if(Auth::check())
                    <a href="{{{ URL::route('blog-post-create') }}}">
                        Create Post
                    </a>
                @else
                    <p>
                        You must <a href="{{{ URL::route('user-sign-in') }}}">sign in</a>
                        or <a href="{{{ URL::route('user-create') }}}">sign up</a> to create a blog post.
                    </p>
                @endif
            </span>

            <span class="search">
                <form action="{{ URL::route('blog-search') }}" method="get">
                    <input type="text" name="s" placeholder="Search blog..."{{ (Input::old('s')) ? ' value="' . e(Input::old('s')) . '"' : '' }}>

                    <button type="submit" class="btn btn-sm">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </form>
            </span>
        </div>

        <div class="show-post">
            <p>
                <h3>{{{ $post->title }}}</h3>

                <p class="post-info">
                    Posted on {{{ date( 'F j, Y', strtotime($post->created_at) ) }}}
                    by <span class="fvbbc">{{{ $post->posted_by }}}</span>
                </p>
            </p>

            <article class="post-content">
                {{ nl2br(e($post->content)) }}
            </article>

            <section id="comments">
                <div class="comment-panel clearfix">
                    <header>
                        <h3>Comments:</h3>

                        @if(Auth::check())
                            <a class="pull-right" href="#comment-form">
                                Leave Comment
                            </a>
                        @else
                            <div class="comment-link pull-right">
                                Please
                                <a href="{{{ URL::route('user-sign-in') }}}">sign in</a>
                                to leave a comment
                            </div>

                        @endif
                    </header>

                    @foreach($comments as $comment)
                        <div class="show-comment">
                            <img class="pull-left" src="{{ asset('static/img/profile_icon.png') }}" alt="Profile Icon">
                            <hgroup>
                                <h4>{{{ $comment->commenter }}}</h4>
                                &nbsp;&bull;
                                <h6>Posted: {{{ date( "M j 'y", strtotime($comment->created_at) ) }}}</h6>
                            </hgroup>
                            <p>
                                {{ nl2br(e($comment->comment)) }}
                            </p>
                        </div>
                    @endforeach

                    @if(Auth::check())
                        <header  class="leave-comment">
                            <h3>Leave a comment:</h3>
                        </header>

                        <form id="comment-form" action="{{{ URL::route('blog-comment', $post->id) }}}" method="post">
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="5">{{ (Input::old('comment')) ? e(Input::old('comment')) : '' }}</textarea>
                            </div>
                            @if ($errors->has('comment'))
                                <span class="help-block">
                                    <span class="error-note">&#42;&nbsp;</span>
                                    {{ $errors->first('comment') }}
                                </span>
                            @endif

                            <button type="submit" class="btn">Post Comment</button>

                            {{ Form::token() }}
                        </form>
                    @endif
                </div>
            </section>
        </div>
    </div>
@stop
