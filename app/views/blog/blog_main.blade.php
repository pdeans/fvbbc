@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/blog.css') }}
@stop

@section('content')

    <div class="main-wrap">
        <hgroup>
            <h2><span class="fvbbc">&#35;FVBBC</span> Blog Page</h2>
            <h4 class="lead">The official blog of the <span class="fvbbc">&#35;FVBBC</span>.</h4>
        </hgroup>

        <div class="blog-header">
            <span class="post-recent">
                <h5>Recent Posts</h5>
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

        <div class="recent">
        @foreach($posts as $post)
            <article class="post-list">
                <h3>
                    {{ link_to_route('blog-post', $post->title, $post->id) }}
                </h3>
                <p class="post-info">
                    <span>
                        Posted on {{{ date( 'F j, Y', strtotime($post->created_at) ) }}}
                        by <span class="fvbbc">{{{ $post->posted_by }}}</span>
                    </span>
                    <span class="label pull-right">
                        <a href="{{{ URL::route('blog-post', $post->id).'#comments' }}}">
                            {{{ $post->comment_count }}} Comments
                        </a>
                    </span>
                </p>
                <p class="post-content">
                    {{{ $post->read_more . ' ...' }}}
                </p>
                <p class="post-full">
                    {{ link_to_route('blog-post', 'Read full article', $post->id) }}
                </p>
            </article>
        @endforeach
        </div>

        <div class="paginate">
            {{ $posts->links() }}
        </div>

    </div>

@stop
