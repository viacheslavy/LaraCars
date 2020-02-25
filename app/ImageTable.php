<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTable extends Model
{
    protected $guarded = ['id'];
    protected $table = "car_images";

    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}
