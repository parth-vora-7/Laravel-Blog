<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Model;

class Blog extends Model
{
    protected $date = ['posted_on'];
	protected $fillable = ['title', 'text', 'posted_on'];
}
