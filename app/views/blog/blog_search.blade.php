@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/blog.css') }}
@stop

@section('content')

    <div class="main-wrap">
        <hgroup>
            <h2><span class="fvbbc">&#35;FVBBC</span> Blog Search</h2>
        </hgroup>

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

        <h6 class="search-title">{{{ $search_title }}}</h6>
        @if($notFound)
            <p class="matches">No matches found.</p>
        @else
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
                        {{{ $post->content . ' ...' }}}
                    </p>
                    <p class="post-full">
                        {{ link_to_route('blog-post', 'Read full article', $post->id) }}
                    </p>
                </article>
            @endforeach

            <div class="paginate">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

@stop
