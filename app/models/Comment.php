<?php


class Comment extends Eloquent {

     /**
     * Comment Model - Fillable
     *
     * @var fillable
     */
    protected $fillable = array(
        'comment',
        'commenter'
    );

    public function post()
    {
        return $this->belongsTo('Post');
    }

}
