<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Car;
use App\Contacts;
use Validator, Cookie;

class MailController extends Controller {

	public function postSendMail(Requests\MailRequest $request) {
		$secret = '6LexhBQUAAAAAEDq7d0aqQWxA13Jly9yy82rQown';
		$gRecaptchaResponse = $request->get('captcha');
		$recaptcha = new \ReCaptcha\ReCaptcha($secret);
		$resp = $recaptcha->verify($gRecaptchaResponse, 'fastandretro.com');
		if($resp->isSuccess()){
			$msg  = "Nom: " . $request->get('name') . "\n\r";
			$msg .= "Prenom: " . $request->get('lname') . "\n\r";
			$msg .= "Email: " . $request->get('email') . "\n\r";
			$msg .= "Telephone: " . $request->get('phone') . "\n\r\n\r";
			$msg .= "Message: " . $request->get('message') . "\n\r\n\r";
			$sub = "Contactez Nous";
			if($request->get('isAdd') === "true" || $request->get('isAdd') === true){
				$sub = "Demande de voiture " . $request->get('name');
				$msg .= "Ad Reference: " . $request->get('ad_reference') . "\n\r";
				$msg .= "Titre De Voiture: " . $request->get('title') . "\n\r";
				$msg .= "Prix: " . $request->get('price') . "\n\r";
				$msg .= "Prix original: $" . $request->get('original_price') . "\n\r";
				$msg .= "Lien original: " . $request->get('original_url') . "\n\r";
				$msg .= "Voir la voiture: " . $request->get('retro_link') . "\n\r";
			}
			Mail::raw($msg, function ($m) use ($request, $sub) {
				$m->from($request->get('email'), 'Fast and Retro');
				$m->to("contact@fastandretro.com")->subject($sub); 
			});
			if($request->ajax()){ return "Votre message a &eacute;t&eacute; envoye!"; }
		}else{
			if($request->ajax()){ return "Captcha is not correct!"; }
			return back()->with('message', 'Captcha is not correct!');
		}
		return back()->with('message', 'Votre message a &eacute;t&eacute; envoye!');
	}

	public function CarSoldDetails(){
		ini_set('max_execution_time', 0);
		$soldStatus = \App\SoldCars::where('date', date('Y-m-d'))->first();
		if(!$soldStatus){
			$soldStatus = \App\SoldCars::create(['date' => date('Y-m-d'), 'status' => true, ]);
			$cars = Car::whereRaw('original_url != ? AND (original_url LIKE ? OR original_url LIKE ?)', ['','%www.ebay.com%', '%www.carsforsale.com%'])->get();
			$carsDetails = [];
			if($cars->count() > 0){
				foreach($cars as  $car){
					if(!empty($car->original_url)){
						if(strpos($car->original_url, 'ebay') !== false){
							$url = $car->original_url;
							$path = public_path() . "/scraperJson/ebay.json";
							if(file_exists($path)){ unlink($path); }
							$scrapyCmd = "source /home/content/env2/bin/activate && scrapy runspider ". public_path() . "/scraper/ebay.py -o " . $path. " -a url='" . $url . "'";
							echo shell_exec($scrapyCmd);
							if(file_exists($path)){
								$str = file_get_contents($path);
								$response = json_decode($str, true);
								if(isset($response[0]) && isset($response[0]['is_sold']) && $response[0]['is_sold']){ $carsDetails[] = $car; }
							}
						}else if(strpos($car->original_url, 'carsforsale') !== false){
							$url = $car->original_url;
							$path = public_path() . "/scraperJson/carsforsale.json";
							if(file_exists($path)){ unlink($path); }
							$scrapyCmd = "source /home/content/env2/bin/activate && scrapy runspider ". public_path() ."/scraper/carsforsale.py -o " . $path. " -a url='" .$url ."'";
							echo shell_exec($scrapyCmd);
							if(file_exists($path)){
								$str = file_get_contents($path);
								$response = json_decode($str, true);
								if(isset($response[0]) && isset($response[0]['is_sold']) && $response[0]['is_sold']){ $carsDetails[] = $car; }
							}
						}
					}
				}
				if(count($carsDetails) > 0){
					Mail::send('admin.carmanager.mailSoldCar', ['carsDetails' => $carsDetails,], function($m){
						$m->to('developerinfo26@gmail.com')->subject("Alerte de suppression d'annonces"); 
						$m->to('contact@fastandretro.com')->subject("Alerte de suppression d'annonces"); 
					});
				}
			}
		}
		return 1;
	}

	public function postSendContact(Requests\MailRequest $request){
		$validator = Validator::make($request->all(), ['email' => 'required|email'], [
			'email' => ':attribute doit être une adresse mail valide.',
		]);
		if($validator->fails()){
			Cookie::queue(Cookie::forget('is_contacted'));
			return redirect('/')->withError($validator->errors()->first());
		}
		$email = $request->get('email');
		$contact = Contacts::where('email', $email)->first();
		if($contact){
			return redirect('/?show=confirm')->with('message', 'Votre message a &eacute;t&eacute; envoye!');
		}
		$reader = new \GeoIp2\Database\Reader(public_path('GeoLite2-City.mmdb'));
		$ip = $request->ip();
		$record = $reader->city($ip);
		$subdivisions = $record->subdivisions;
		$latitude = null;
		$longitude = null;
		if(isset($record->location)){
			if(isset($record->location->latitude)){ $latitude = $record->location->latitude; }
			if(isset($record->location->longitude)){ $longitude = $record->location->longitude; }
		}
		$address = null;
		if(isset($record->city) && isset($record->city->name)){ $address .= $record->city->name; }
		if(is_array($subdivisions) && count($subdivisions) > 0 && isset($subdivisions[0]->name)){ $address .= ', ' . $subdivisions[0]->name; }
		if(isset($record->country) && isset($record->country->name)){ $address .= ', ' . $record->country->name; }
		$msg = "Email: " . $email . "\n\r";
		$msg .= "Ip: " . $ip . "\n\r";
		$msg .= "Address: " . $address . "\n\r";
		$msg .= "Latitude: " . $latitude . "\n\r";
		$msg .= "Longitude: " . $longitude . "\n\r";
		$sub = "New Newsletter Subscription";
		Mail::raw($msg, function($m) use($email, $sub){
			$m->from($email, 'Fast and Retro');
			$m->to("developerinfo26@gmail.com")->subject($sub); 
			$m->to("contact@fastandretro.com")->subject($sub); 
		});
		Contacts::create(['email' => $email, 'ip' => $ip, 'latitude' => $latitude, 'longitude' => $longitude, 'address' => $address,]);
		return redirect('/?show=confirm')->with('message', 'Votre message a &eacute;t&eacute; envoye!');
	}
}
