<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Comment extends Eloquent
{
	use SoftDeletes;
    protected $fillable = ['text', 'user_id', 'blog_id', 'deleted_at'];

    public function blog() {
    	return $this->belongsTo('App\Blog');
    }

    public function user() {
		return $this->belongsTo('App\User');
    }
}
