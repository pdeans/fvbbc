<?php


class Post extends Eloquent {

    /**
     * Post Model - Fillable
     *
     * @var fillable
     */
    protected $fillable = array(
        'title',
        'content'
    );

    public function comments()
    {
        return $this->hasMany('Comment');
    }

}
