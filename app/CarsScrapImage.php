<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarsScrapImage extends Model
{
    protected $guarded = ['id'];
    protected $table = "car_scraped_images";

    public function car()
    {
        return $this->belongsTo('App\CarsScraped');
    }
    public function CarImg(){
    	return $this->belongsTo('App\CarsScraped', 'car_id', 'id');
    }
}
