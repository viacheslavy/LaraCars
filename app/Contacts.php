<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model {
	
	protected $guarded = ['id'];
	protected $table = "contacts";
}