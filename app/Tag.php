<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Tag extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get al blogs which are tagged with a specific tag
     * 
     * @return mix
     */
    public function blogs() {
        return $this->belongsToMany('App\Blog');
    }
}
