<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GlobalPriceSetting extends Model
{
    protected $guarded = ['id'];
    protected $table = "global_price_settings";
}
