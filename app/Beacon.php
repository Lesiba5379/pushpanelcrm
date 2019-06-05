<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Author: Lesiba Nxumalo
 * Desc: db relationship
 */
class Beacon extends Model
{

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function campaign(){
        return $this->hasOne('App\Campaign');
    }
}