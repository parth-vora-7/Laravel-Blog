<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Blog extends Model
{

	use SoftDeletes;

	/**
     * The storage format of the model's date columns.
     *
     * @var string
     */

   // protected $dateFormat = 'd-m-Y H:i:s';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = 
    [
        'published_on',
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = 
    [
	 	'title', 
	 	'text', 
        'published_on',
	 	'blog_image',
        'commenting',
        'deleted_at',
        'user_id'
 	];

    /**
     * Accessor for published_on field
     * To change the the format of published_on field while accessing it
     * @var $value string
     * @return Carbon
     */
    public function getPublishedOnAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    /**
     * Mutator for published_on field
     * To change the the format of published_on field while storing it
     * @var $value string
     */
    public function setPublishedOnAttribute($value)
    {
        $this->attributes['published_on'] = Carbon::parse($value)->format('d-m-Y H:i:s');
    } 

    /**
     * Get author of a blog
     * 
     * @return mix
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }

	/**
     * To ckeck whether a blog has been published yet or not
     */
    public function scopePublished($query) 
    {
        $query->where('published_on', '<=', Carbon::now()->format('d-m-Y H:i:s'));
    }

    /**
     * Get all the tags of a blog
     * 
     * @return mix
     */
    public function tags() 
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get all the tags of a blog to prepolulate the tag field on edit form
     * 
     * @return mix
     */
    public function getTagListAttribute() 
    {
        return $this->tags->pluck('id')->toArray();
    }

    /**
     * Get all the comments of a blog
     * 
     * @return mix
     */
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
