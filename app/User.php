<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Moloquent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use Carbon\Carbon;

class User extends Moloquent implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, SoftDeletes, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'contact_no', 'gender', 'country', 
        'hobbies', 'about_me', 'date_of_birth', 'avatar', 'user_type', 
        'social_id', 'registration_type', 'slack_webhook_url', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'hobbies' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date_of_birth',
        'deleted_at',
        'trial_ends_at'
    ];

     /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    //protected $dateFormat = 'd-m-Y H:i:s';

    /**
     * To ckeck whether passed user is admin or not
     */
    public function isAdmin()
    {
        return ($this->user_type == 'admin') ? true : false;
    }
    
    /**
     * Accessor for date_of_birth field
     * To change the the format of date_of_birth field while accessing it
     * @var $value string
     * @return Carbon
     */
    public function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    /**
     * Mutator for date_of_birth field
     * To change the the format of date_of_birth field while storing it
     * @var $value string
     */

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::parse($value)->format('d-m-Y H:i:s');
    } 

    /**
     * Get blogs of a user
     * 
     * @return mix
     */
    
    public function blogs() {
        return $this->hasMany('App\Blog');
    }

    /**
     * Get blog comments of a user
     * 
     * @return mix
     */
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }

    public function routeNotificationForNexmo()
    {
        return $this->contact_no;
    }
}
