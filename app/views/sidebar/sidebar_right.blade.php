<aside class="sidebar-right pull-right hidden-md hidden-sm hidden-xs">

    <h2>Latest Blog Posts</h2>

    @foreach($recentPosts as $posts)
    <div class="post-listing">
        <h3>
            <a href="{{{ URL::route('blog-post', $posts->id) }}}">
                {{{ strlen($posts->title) > 20 ? substr($posts->title, 0, 20).'...' : $posts->title }}}
            </a>
        </h3>
        <div class="post-info">
            <p>
                Posted: {{{ date( 'F j, Y', strtotime($posts->created_at) ) }}}
                by <span class="fvbbc">{{{ strlen($posts->posted_by) > 10 ? substr($posts->posted_by, 0, 10).'...' : $posts->posted_by }}}</span>
            </p>
            <p class="info-comment pull-right">
                <a href="{{{ URL::route('blog-post', $posts->id).'#comments' }}}">
                    {{{ $posts->comment_count }}} Comments
                </a>
            </p>
        </div>
    </div>
    @endforeach

</aside>
