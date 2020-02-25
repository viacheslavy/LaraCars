<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jewel extends Model
{
    protected $table = "jewels";

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'date', 'car_id', 'created_at', 'updated_at',
    ];

    public function car(){
    	return $this->hasOne('App\Car', 'id', 'car_id');
    }

}
