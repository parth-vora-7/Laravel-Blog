<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comment extends Eloquent
{
	use SoftDeletes;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'user_id', 'blog_id', 'parent_id', 'deleted_at'];

    /**
     * Get the blog of a comment
     * 
     * @return mix
     */
    public function blog() {
    	return $this->belongsTo('App\Blog');
    }

    /**
     * Get all the comments of a user
     * 
     * @return mix
     */
    public function user() {
		return $this->belongsTo('App\User');
    }

    /**
     * Get paranet comment of a comment
     * 
     * @return mix
     */
    public function parentComment() {
        return $this->belongsTo('App\Comment', 'parent_id');
    }

    /**
     * Get all the comments of a comment
     * 
     * @return mix
     */
    public function childComments() {
        return $this->hasMany('App\Comment', 'parent_id');
    }
}
