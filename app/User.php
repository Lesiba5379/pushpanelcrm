<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * Author: Lesiba Nxumalo(Cool developer).
 * Desc: Relationships, and more.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use LaratrustUserTrait; // add this trait to your user model

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status',
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
     * get employees of a company
     */
    public function employees(){
        return $this->hasMany(Employee::class);
    }
    
    /**
     * return relation type of beacon class.
     */
    public function beacons(){
        return $this->hasMany(Beacon::class);
    }
    //extends user table by creating one to one relationship.

    public function profile(){
        return $this->hasOne('\App\Profile');
    }

    /**
     * @function
     * @name 
     * @returns object 
     * 
     */
    public function campaign(){
        return $this->hasMany('\App\Campaign');
    }
}
