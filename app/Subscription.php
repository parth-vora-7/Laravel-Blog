<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
	'user_id', 'name', 'stripe_id', 'stripe_plan', 'quantity', 'trial_ends_at', 'ends_at'
	];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
    'trial_ends_at',
    'ends_at'
    ];

     /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
     protected $dateFormat = 'd-m-Y H:i:s';
 }
