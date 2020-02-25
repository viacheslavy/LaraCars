<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayType extends Model
{
    protected $table = 'pay_type';
    protected $fillable = ['type'];
}
