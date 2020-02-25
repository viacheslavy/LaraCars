<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth, Session;

class Car extends Model {
	protected $guarded = ['id'];

	public function images(){
		return $this->hasMany('App\ImageTable');
	}

	public static function getFileContent($path){
		$str = file_get_contents($path);
		return json_decode($str, true);
	}

	public static function getEbay($params, $page){ 
		$path = public_path() . "/scraperJson/getdata_ebay_" . Session::getId() . ".json";
		if(file_exists($path)){ unlink($path); }
		$make = $params['make'];
		$year1 = $params['year1'];
		$year2 = $params['year2'];
		$model = $params['model'];
		$color = $params['color'];
		$keyword = $params['keyword'];
		$miles = intval($params['miles']);
		$price1 = intval($params['price1']);
		$price2 = intval($params['price2']);
		if(empty($year1)){ $year1 = ''; }
		if(empty($year2)){ $year2 = ''; }
		if($miles == 0 || $miles == '0'){ $miles = ''; }
		else{ $miles = number_format($miles); }
		if($price1 == 0 || $price1 == '0'){ $price1 = ''; }
		else{ $price1 = number_format($price1); }
		if($price2 == 0 || $price2 == '0'){ $price2 = ''; }
		else{ $price2 = number_format($price2); }
		if($page == 1 ){ $page = ''; };
		$scrapyCmd = "source /home/content/env2/bin/activate && scrapy runspider ". public_path() . "/scraper/getdata_ebay_new.py -o " . $path . " -a brand='" . $make . "' -a model='" . $model . "' -a start_year=" . $year1 . " -a end_year=" . $year2 . " -a start_price=" . $price1 . " -a end_price=" . $price2 . " -a mileage=" . $miles . " -a exterior=" . $color . " -a interior= -a page_number=" . $page;
file_put_contents(public_path()."/scrapycmd.txt",$scrapyCmd);
		echo shell_exec($scrapyCmd);
		return Car::getFileContent($path);
	}

	public static function getCarsforsale($params, $page){
		$path = public_path() . "/scraperJson/getdata_carsforsale_" . Session::getId() . ".json";
		if(file_exists($path)){ unlink($path); }
		$make = $params['make'];
		$year1 = $params['year1'];
		$year2 = $params['year2'];
		$model = $params['model'];
		$color = $params['color'];
		$keyword = $params['keyword'];
		$miles = intval($params['miles']);
		$price1 = intval($params['price1']);
		$price2 = intval($params['price2']);
		if(empty($year1)){ $year1 = ''; }
		if(empty($year2)){ $year2 = ''; }
		if($miles == 0 || $miles == '0'){ $miles = ''; }
		else{ $miles = number_format($miles); }
		if($price1 == 0 || $price1 == '0'){ $price1 = ''; }
		else{ $price1 = $price1; }
		if($price2 == 0 || $price2 == '0'){ $price2 = ''; }
		else{ $price2 = $price2; }
		if($page == 1){ $page = ''; };
		$scrapyCmd = "source /home/content/env2/bin/activate && scrapy runspider ". public_path() . "/scraper/getdata.py -o " . $path . " -a brand='" . $make . "' -a model='" . $model . "' -a start_year=" . $year1 . " -a end_year=" . $year2 . " -a start_price=" . $price1 . " -a end_price=" . $price2 . " -a mileage=" . $miles . " -a exterior= -a interior= -a page_number=" . $page . " -a color=" . $color;
		echo shell_exec($scrapyCmd);
		return Car::getFileContent($path);
	}

	public static function getHemmings($params, $page){
		$path = public_path() . "/scraperJson/getdata_hemmings_" . Session::getId() . ".json";
		if(file_exists($path)){ unlink($path); }
		$make = $params['make'];
		$year1 = $params['year1'];
		$year2 = $params['year2'];
		$model = ucwords($params['model']);
		$color = $params['color'];
		$keyword = $params['keyword'];
		$miles = intval($params['miles']);
		$price1 = intval($params['price1']);
		$price2 = intval($params['price2']);
		if(empty($year1)){ $year1 = ''; }
		if(empty($year2)){ $year2 = ''; }
		if($miles == 0 || $miles == '0'){ $miles = ''; }
		else{ $miles = number_format($miles); }
		if($price1 == 0 || $price1 == '0'){ $price1 = ''; }
		else{ $price1 = $price1; }
		if($price2 == 0 || $price2 == '0'){ $price2 = ''; }
		else{ $price2 = $price2; }
		if($page == 1){ $page = ''; };
		$scrapyCmd = "source /home/content/env2/bin/activate && scrapy runspider ". public_path() . "/scraper/hemmings_new.py -o " . $path . " -a brand='" . $make . "' -a start_year=" . $year1 . " -a end_year=" . $year2 . " -a start_price=" . $price1 . " -a end_price=" . $price2 . " -a page_number=" . $page . " -a model='" . $model . "' -a model_group_facet= -a model_facet='" . $model . "'";
		echo shell_exec($scrapyCmd);
		return Car::getFileContent($path);
	}

	public static function getGateWayClassicCars($params, $page){
		$path = public_path() . "/scraperJson/getdata_gatewayclassiccars_" . Session::getId() . ".json";
		if(file_exists($path)){ unlink($path); }
		$make = $params['make'];
		$year1 = $params['year1'];
		$year2 = $params['year2'];
		$model = $params['model'];
		$color = $params['color'];
		$keyword = $params['keyword'];
		$miles = intval($params['miles']);
		$price1 = intval($params['price1']);
		$price2 = intval($params['price2']);
		if(empty($year1)){ $year1 = ''; }
		if(empty($year2)){ $year2 = ''; }
		if($miles == 0 || $miles == '0'){ $miles = ''; }
		else{ $miles = number_format($miles); }
		if($price1 == 0 || $price1 == '0'){ $price1 = ''; }
		else{ $price1 = number_format($price1); }
		if($price2 == 0 || $price2 == '0'){ $price2 = ''; }
		else{ $price2 = number_format($price2); }
		if($page == 1 ){ $page = ''; };
		$scrapyCmd = "source /home/content/env2/bin/activate && scrapy runspider ". public_path() . "/scraper/gatewayclassiccars.py -o " . $path . " -a brand='" . $make . "' -a model='" . $model . "' -a start_year=" . $year1 . " -a end_year=" . $year2 . " -a start_price=" . $price1 . " -a end_price=" . $price2 . " -a mileage=" . $miles . " -a exterior=" . $color . " -a interior= -a page_number=" . $page . " -a eng='' -a tra=''";
		// echo $scrapyCmd;exit;
		echo shell_exec($scrapyCmd);
		return Car::getFileContent($path);
	}

	protected static $cards = array(
		// Debit cards must come first, since they have more specific patterns than their credit-card equivalents.
		'visaelectron' => array(
			'type' => 'visaelectron',
			'pattern' => '/^4(026|17500|405|508|844|91[37])/',
			'length' => array(16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'maestro' => array(
			'type' => 'maestro',
			'pattern' => '/^(5(018|0[23]|[68])|6(39|7))/',
			'length' => array(12, 13, 14, 15, 16, 17, 18, 19),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'forbrugsforeningen' => array(
			'type' => 'forbrugsforeningen',
			'pattern' => '/^600/',
			'length' => array(16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'dankort' => array(
			'type' => 'dankort',
			'pattern' => '/^5019/',
			'length' => array(16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		// Credit cards
		'visa' => array(
			'type' => 'visa',
			'pattern' => '/^4/',
			'length' => array(13, 16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'mastercard' => array(
			'type' => 'mastercard',
			'pattern' => '/^(5[0-5]|2[2-7])/',
			'length' => array(16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'amex' => array(
			'type' => 'amex',
			'pattern' => '/^3[47]/',
			'format' => '/(\d{1,4})(\d{1,6})?(\d{1,5})?/',
			'length' => array(15),
			'cvcLength' => array(3, 4),
			'luhn' => true,
		),
		'dinersclub' => array(
			'type' => 'dinersclub',
			'pattern' => '/^3[0689]/',
			'length' => array(14),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'discover' => array(
			'type' => 'discover',
			'pattern' => '/^6([045]|22)/',
			'length' => array(16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
		'unionpay' => array(
			'type' => 'unionpay',
			'pattern' => '/^(62|88)/',
			'length' => array(16, 17, 18, 19),
			'cvcLength' => array(3),
			'luhn' => false,
		),
		'jcb' => array(
			'type' => 'jcb',
			'pattern' => '/^35/',
			'length' => array(16),
			'cvcLength' => array(3),
			'luhn' => true,
		),
	);

	public static function creditCardType($number){
		foreach(self::$cards as $type => $card){
			if(preg_match($card['pattern'], $number)){
				return $type;
			}
		}
		return '';
	}
}
