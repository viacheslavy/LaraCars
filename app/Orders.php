<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model{
    protected $table = 'orders';
    protected $fillable = ['occupation_type', 'civility', 'name', 'amount', 'family_name', 'email', 'address', 'additional_address', 'city', 'state', 'country', 'zip_code', 'phone', 'phone_fixed', 'building', 'staircase', 'floor', 'door', 'car_id', 'newsletter', 'card_user', 'card_name', 'card', 'month_year', 'responseCode', 'transId', 'authCode', 'type', 'created_at', 'updated_at',];

    public function car(){
		return $this->hasOne('App\Car','id', 'car_id');
	}
}
