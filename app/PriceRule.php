<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceRule extends Model {

	protected $table = "price_rule";

	protected $fillable = ['start_price', 'end_price', 'price', 'percentage', 'site', 'default_rule',];

	public static function getPrice($price, $pricerules, $carsite){
		ini_set('max_execution_time', 0);
		$pricerule = NULL; 
		if($pricerules->count() > 0){
			$pricetype = '';
			$data = [];
			$priceruleId = NULL;
			foreach($pricerules as $value){
				if(strpos($carsite, $value->site) !== false || $value->site == 'all' ){
					if(in_array($price, range($value->start_price, $value->end_price))){
						$pricerule = $value;
						break;
					}
				}
			}
		}
		if($pricerule == NULL){
			$rule = PriceRule::where('default_rule', 1)->first();
			if(!$rule){ $rule = PriceRule::create([ 'start_price' => 0, 'end_price' => 0, 'price' => '8000', 'percentage' => '6', 'default_rule' => 1, ]); }
			$percent = ($rule->percentage / 100) * $price;
			$price = $price + $rule->price;
			$price = $price + $percent;
			// $data = ['price' => round($price), 'price_rule_id' => $rule->id, ];
			$data = ['price' => (ceil($price / 100) * 100), 'price_rule_id' => $rule->id, ];
		}else{
			$percent = ($pricerule->percentage / 100) * $price;
			$price = $price + $pricerule->price;
			$price = $price + $percent;
			// $data = ['price' => round($price), 'price_rule_id' => $pricerule->id, ];
			$data = ['price' => (ceil($price / 100) * 100), 'price_rule_id' => $pricerule->id, ];
		}
		return $data;
	}

}