@extends('layouts.base')

@section('head')
    {{ HTML::style('static/css/blog.css') }}
@stop

@section('content')
    <div class="main-wrap blog-create clearfix">
        <h2>Create <span class="fvbbc">&#35;FVBBC</span> Blog Post</h2>

        <div class="blog-header">
            <span class="back-link">
                <a href="{{{ URL::route('blog') }}}">Back</a>
            </span>

            <span class="search">
                <form action="{{ URL::route('blog-search') }}" method="get">
                    <input type="text" name="s" placeholder="Search blog..."{{ (Input::old('s')) ? ' value="' . e(Input::old('s')) . '"' : '' }}>

                    <button type="submit" class="btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </form>
            </span>
        </div>

        <form action="{{ URL::route('blog-post-save') }}" method="post">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Enter title..."{{ (Input::old('title')) ? ' value="' . e(Input::old('title')) . '"' : '' }} autofocus>
            </div>
            @if ($errors->has('title'))
                <span class="help-block">
                    <span class="error-note">&#42;&nbsp;</span>
                    {{ $errors->first('title') }}
                </span>
            @endif

            <div class="form-group">
                <label>Content:</label>
                <textarea name="content" class="form-control" rows="20" placeholder="Main content goes here...">{{ (Input::old('content')) ? Input::old('content') : '' }}</textarea>
            </div>
            @if ($errors->has('content'))
                <span class="help-block">
                    <span class="error-note">&#42;&nbsp;</span>
                    {{ $errors->first('content') }}
                </span>
            @endif

            <button type="submit" class="btn btn-lg">Create Post</button>

            {{ Form::token() }}
        </form>
    </div>
@stop
