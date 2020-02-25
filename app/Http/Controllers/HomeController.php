<?php

namespace App\Http\Controllers;

use App\Make;
use App\Car;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Jewel;
use Cache, Carbon\Carbon;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(){
		// $this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function home(){
		$expiresAt = Carbon::now()->addHours(24);
		$makes = Cache::get('makes');
		if(!$makes){
			$makes = \App\Make::where('status', true)->orderBy("name", "ASC")->get();
			Cache::put('makes', $makes, $expiresAt);
		}
		$allCars = Cache::get('allCars');
		if(!$allCars){
			$allCars = \App\Car::all();
			Cache::put('allCars', $allCars, $expiresAt);
		}
		$cars = $allCars->filter(function($car){ return $car->expired == false; });
		$similars = Cache::get('similars');
		if(!$similars){
			// $similars = $allCars->sortByDesc(function($car){ return $car->created_at; })->take(10);
			$similars = $allCars->whereIn('id', [18427,18426,18425,18423,18417,18416,18415,18412,18409,18408])->take(10);
			Cache::put('similars', $similars, $expiresAt);
		}
		$makedetails = Cache::get('makedetails');
		if(!$makedetails){
			$makedetails = [];
			foreach($makes as $key => $value){
				// $count = $cars->where("brand", $value->name)->count();
				$count = $cars->filter(function($car) use($value){ return ($car->brand == $value->name); })->count();
				if($count > 0){ $makedetails[] = $value; };
			};
			if(count($makedetails) > 0){ Cache::put('makedetails', $makedetails, $expiresAt); }
		}
		$modeldetails = [];
		$car = Cache::get('car');
		if(!$car){
			$jewel = Jewel::orderBy('date','desc')->first();
			if($jewel && $jewel->car){ $car = $jewel->car; }
			else{
				// $car = Car::inRandomOrder()->first();
				$car = $allCars->random();
			}
			Cache::put('car', $car, $expiresAt);
		}
		return view('home', ['car' => $car, 'makedetails' => $makedetails, 'modeldetails' => $modeldetails, 'isMake' => false, 'similars' => $similars,]);
	}

	public function presentation(){
		return view('presentation');
	}

	public function etape(){
		return view('etape');
	}

	public function faq(){
		return view('faq');
	}

	public function guarantee(){
		return view('guarantee');
	}

	public function testimonials(){
		return view('testimonials');
	}

	public function videoTestimonials(){
		return view('videotestimonials');
	}

	public function contact(){
		return view('contact');
	}

	public function cropper(){
		return view('cropper');
	}

	public function getLegals(){
		return view('legals');
	}

	public function getCaptcha(){
		if(!Session::has('rand_code')){
			$str = "";
			$length = 0;
			for($i = 0; $i < 4; $i++){
				// this numbers refer to numbers of the ascii table (small-caps)
				$str .= chr(rand(97, 122));
			}
			Session::put('rand_code', $str);
		}
		$imgX = 210;
		$imgY = 70;
		$image = imagecreatetruecolor($imgX, $imgY);
		$backgr_col = imagecolorallocate($image, 238, 239, 239);
		$border_col = imagecolorallocate($image, 208, 208, 208);
		$text_col = imagecolorallocate($image, 46, 60, 31);
		imagefilledrectangle($image, 0, 0, $imgX, $imgY, $backgr_col);
		imagerectangle($image, 0, 0, $imgX - 1, $imgY - 1, $border_col);
		$white = imagecolorallocate($image, 255, 255, 255);
		$black = imagecolorallocate($image, 0, 0, 0);
		for($i = 0; $i < 50; $i++){
			//imagefilledrectangle($im, $i + $i2, 5, $i + $i3, 70, $black);
			imagesetthickness($image, rand(1, 5));
			imagearc(
				$image,
				rand(1, 300), // x-coordinate of the center.
				rand(1, 300), // y-coordinate of the center.
				rand(1, 300), // The arc width.
				rand(1, 300), // The arc height.
				rand(1, 300), // The arc start angle, in degrees.
				rand(1, 300), // The arc end angle, in degrees.
				(rand(0, 1) ? $black : $white) // A color identifier.
			);
		}
		$font = public_path("VeraSe.ttf"); // it's a Bitstream font check www.gnome.org for more
		$font_size = 35;
		$angle = 0;
		$box = imagettfbbox($font_size, $angle, $font, Session::get('rand_code'));
		$x = (int)($imgX - $box[4]) / 2;
		$y = (int)($imgY - $box[5]) / 2;
		imagettftext($image, $font_size, $angle, $x, $y, $text_col, $font, Session::get('rand_code'));
		header("Content-type: image/png");
		imagepng($image);
		imagedestroy ($image);
	}
}