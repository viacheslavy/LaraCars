<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id'];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
