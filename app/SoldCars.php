<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoldCars extends Model {

	protected $table = "sold_cars";
	protected $fillable = ['id', 'date', 'status', 'created_at', 'updated_at'];
}