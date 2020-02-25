<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsScraped extends Model
{
    protected $guarded = ['id'];
    protected $table = "cars_scraped";

    public function CarImg(){
    	return $this->hasMany('App\CarsScrapImage', 'car_id', 'id');
    }
    public function CarImg1(){
    	return $this->hasOne('App\CarsScrapImage', 'car_id', 'id');
    }
}
