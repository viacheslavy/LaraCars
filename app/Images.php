<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model {
	
	protected $table = "images";

	protected $fillable = [ 'id', 'medium', 'big', 'featured', 'created_at', 'updated_at', ];

}