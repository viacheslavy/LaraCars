<?php

namespace App\Http\Controllers;

use App\Car;
use App\Orders;
use App\Make;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Payeezy_Client;
use Payeezy_CreditCard;
use Payeezy_Error;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\PayType;
use Validator;
use View, Cache, Carbon\Carbon;

class CarsFEController extends Controller {

	public function index(){
		$cars = Car::inRandomOrder()->paginate(12);
		$makes = \App\Make::where('status', true)->orderBy("name", "ASC")->get();
		$carsdetail = \App\Car::where('expired', false)->get();
		$makedetails = [];
		foreach($makes as $key => $value){
			$count = $carsdetail->where("brand", $value->name)->count();
			if($count > 0){ $makedetails[] = $value; };
		};
		$modeldetails = \App\MakeModel::where('status', true)->orderBy("name", "ASC")->get();
		return view('index', ['cars' => $cars, 'makedetails' => $makedetails, 'modeldetails' => $modeldetails, 'isMake' => false,]);
	}

	public function getProduct($id){
		$translate = [
			"Yellow" => "Jaune", "Blue" => "Bleu", "Black" => "Noir", "White" => "Blanc", "Blue and White" => "Bleu et blanc",
			"BlueandWhite" => "Bleu et blanc", "Red" => "Rouge", "Brown" => "Brun", "Tan" => "Brun",
			"Green" => "Vert", "SILVER" => "Argent", "Gray" => "Gris", "Gold" => "Or", "Orange" => "Orange",
			"Blue and Gray" => "Bleu et Gris", "BlueandGray" => "Bleu et Gris", "white/black" => "blanc/noir",
			"white / black" => "blanc/noir", "Dark Blue" => "Bleu foncé", "DarkBlue" => "Bleu foncé", "Turquoise" => "Turquoise",
			"Red and Black" => "Rouge et Noir", "RedandBlack" => "Rouge et Noir", "Satin Red" => "Rouge satin", "SatinRed" => "Rouge satin", 
			"Grey" => "Gris", "Caribbean Blue" => "Bleu caraibe", "CaribbeanBlue" => "Bleu caraibe", "Bronze" => "Bronze",
			"WHITE WITH GREEN TOP" => "blanc avec capote verte", "WHITEWITHGREENTOP" => "blanc avec capote verte",
			"GREEN AND WHITE" => "vert et blanc", "GREENANDWHITE" => "vert et blanc", "MARLBORO MAROON" => "marron", "MARLBOROMAROON" => "marron",
			"Daytona blue" => "bleu", "Daytonablue" => "bleu", "Teal was candy apple red" => "rouge", "CARDINAL RED" => "rouge", "CARDINALRED" => "rouge",
			"Frost Beige" => "beige", "FrostBeige" => "beige", "Brown and Black" => "martin et noir", "BrownandBlack" => "martin et noir",
			"Black/Brown" => "noir/marron", "BlackBrown" => "noir/marron", "Black Brown" => "noir/marron", "Off White" => "blanc casse", "OffWhite" => "blanc casse",
			"Tan Leather" => "marron", "TanLeather" => "marron", "Burgundy Red" => "bordeaux", "BurgundyRed" => "bordeaux", "Tan/Red" => "marron/rouge", "TanRed" => "marron/rouge",
			"Blue Vinyl or red leather" => "vynil bleu ou cuir rouge", "Custom" => "sur mesure", "Sublime Green" => "vert", "SublimeGreen" => "vert", "White & Tan" => "blanc et marron",
			"White and Tan" => "blanc et marron", "Cortez Silver" => "gris", "CortezSilver" => "gris", "Daytona Yellow" => "jaune", "DaytonaYellow" => "jaune", "Automatic 4-Speed" => "Automatique 4 vitesses",
			"Automatic4-Speed" => "Automatique 4 vitesses", "Automatic 3-Speed" => "Automatique 3 vitesses", "Automatic3-Speed" => "Automatique 3 vitesses", "Automatic" => "Automatique",
			"Manual" => "Manuelle", "2 Speed Automatic" => "Automatique 2 vitesses", "2SpeedAutomatic" => "Automatique 2 vitesses", "4 Speed Manual" => "Manuelle 4 vitesses", 
			"4SpeedManual" => "Manuelle 4 vitesses", "5 Speed (Tremec)" => "5 vitesses (Tremec)", "5Speed(Tremec)" => "5 vitesses (Tremec)", "Manual 3-Speed" => "Manuelle 3 vitesses",
			"Manual3-Speed" => "Manuelle 3 vitesses",
		];
		$car = Car::find($id);
		if($car) return view('single', compact('car', 'translate'));
		//if($car) return view('testPayment', compact('car', 'translate'));
		else return redirect()->route('get.home');
	}

	public function getMakesJson($id){		
		$expiresAt = Carbon::now()->addHours(24);
		$make = Make::find($id);
		if(!$make){ response()->json([]); }
		$models = Cache::get('models-' . $make->id);
		if(!$models){
			$models = [];
			$cars = \App\Car::where('expired', false)->get();
			$models1 = \App\MakeModel::whereRaw('make_id = ? AND status = ?', [$id, true,])->orderBy("name", "ASC")->get();
			foreach($models1 as $key => $value){
				$count = $cars->filter(function($item) use($value){
					if(empty($item->model) || empty($value->name)){
						return false;
					}else{
						return (strpos(strtolower($item->model), strtolower($value->name)) !== false || strpos(strtolower($item->model), strtolower($value->value)) !== false);
					}
				});
				if($count->count() > 0){  $models[] = ['value' => $value->name, 'label' => $value->name, ]; }
			}
			Cache::put('models-' . $make->id, $models, $expiresAt);
		}
		return response()->json($models);
	}

	public function getSearch(){
		$cars = new Car;
		$isMake = false;
		if(Input::get('brand') != ""){
			$cars = $cars->where('brand', 'LIKE', '%'. Input::get('brand') .'%');
		}
		if(Input::get('model') != ""){
			$isMake = true;
			$cars = $cars->where('model', 'LIKE', '%' . Input::get('model') . '%');
		}
		if(Input::get('year1') != "" && Input::get('year2') != ""){
			$cars = $cars->whereBetween('year', [intval(Input::get('year1')), intval(Input::get('year2'))]);
		}
		if(Input::get('sortby') != ""){
			$explode = explode("|", Input::get('sortby'));
			$first = $explode[0];
			$second = $explode[1];
			$cars = $cars->orderBy($first, $second);
		}
		$cars = $cars->orderBy('created_at', 'DESC')->paginate(12);
		$carsdetail = \App\Car::where('expired', false)->get();
		$makes = \App\Make::where('status', true)->orderBy("name", "ASC")->get();
		$makedetails = [];
		foreach($makes as $key => $value){
			$count = $carsdetail->where("brand", $value->name)->count();
			if($count > 0){ $makedetails[] = $value; };
		};
		$modeldetails = [];
		if(Input::get('model') != ""){
			$make = \App\Make::where('status', true)->where('name', 'LIKE', '%'. Input::get('brand') .'%')->first();
			if($make){
				$modeldetails = \App\MakeModel::whereRaw('make_id = ? AND status = ?', [$make->id, true,])->orderBy("name", "ASC")->get();
			}
		};
		return view('index', ['cars' => $cars, 'makedetails' => $makedetails, 'modeldetails' => $modeldetails, 'isMake' => $isMake,  ]);
	}

	public function getSmallSearch(){
		$cars = Car::where('title', 'LIKE', '%'. Input::get('search') .'%')->orderBy('created_at', 'DESC')->paginate(12);
		$makedetails = \App\Make::where('status', true)->orderBy("name", "ASC")->get();
		$modeldetails = \App\MakeModel::where('status', true)->orderBy("name", "ASC")->get();
		return view('index', ['cars' => $cars, 'makedetails' => $makedetails, 'modeldetails' => $modeldetails, 'isMake' => false, ]);
	}

	public static function checkRemoteFile($url){
		$ch = curl_init();
		$url = str_replace("%3A", ":", str_replace("%2F", "/", rawurlencode($url)));
		curl_setopt($ch, CURLOPT_URL, $url);
		// don't download content
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(curl_exec($ch) !== FALSE){ return 1; }
		else{ return 0; }
	}

	public function postCarReserve(Request $request){
		$validator = Validator::make($request->all(), [
			'civility' => 'required',
			'carId' => 'required',
			'card' => 'required',
			'month' => 'required',
			'year' => 'required',
			'cvv' => 'required',
			'amount' => 'required|integer',
			'name' => 'required',
			'family_name' => 'required',
			//'email' => 'required|email',
		]);
		if($validator->fails()) return response()->json(['error' => "validation failed!!!"], 401);
		$data = $request->except(['_token']);
		$car = Car::find($data['carId']);
		$cardType = Car::creditCardType($data['card']);
		if($car){
			if($request->has('amount')){ $amount = $request->get('amount'); }
			else $amount = '1000';
			$type = PayType::first();
			if(!$type){ $type = PayType::create(['payzee']); }
			if($type){
				if($type->type == 'payzee'){
					$exp_date = $request->get('month') . '' . substr($request->get('year'), -2);
					$client = new Payeezy_Client();
					//Demo
					/*$client->setApiKey("uG6cc8YpDHaX03bFF02TOEZ5Qp9tqjGO");
					$client->setApiSecret("216cda18a998719e10aa3258dd5864026fc2a501099311170ddc0a7955d63397");
					$client->setMerchantToken("fdoa-f1732c37762367d3614c04f72fa862e6f1732c37762367d3");*/
					/*$client->setApiKey("5O5CS2NeGikEPmkmW4tCZlKvOidloUpQ");
					$client->setApiSecret("023e6d3e450f6ce5a41318e6d1ad1ca4ca9df72347785e7e40c4467079e7217b");
					$client->setMerchantToken("fdoa-d0bf200e3bb3ad314c5b4f1094463402d0bf200e3bb3ad31");*/
					/* Live */
					$client->setApiKey("A3kFwWvHiZoz0nrjbF3pugv0qmOsiogs");
					$client->setApiSecret("8d0e57833ed492102ba26e8d2bf85c057e86914c9ae44b9a861f4fa48ad5cd47");
					$client->setMerchantToken("fdoa-15bc61da43203d1a62d5fb25e5e0541c15bc61da43203d1a");
					// $client->setUrl("https://api-cert.payeezy.com/v1/transactions");
					$client->setUrl("https://api.payeezy.com/v1/transactions");
					$card_transaction = new Payeezy_CreditCard($client);
					try{
						$response = $card_transaction->purchase([
							"merchant_ref" => "GODADDY",
							"amount" => (int) $amount * 100,
							"currency_code" => "USD",
							"credit_card" => array(
								"type" => $cardType,
								"cardholder_name" => $request->get('name'),
								"card_number" => $request->get('card'),
								"exp_date" => $exp_date,
								"cvv" => $request->get('cvv')
							)
						]);
						if(isset($response->transaction_status) && $response->transaction_status == "approved"){
							$msg  = "Numéro d'identification de la voiture: " . $car->id . "\n\r";
							$msg .= "Titre de la voiture: " . $car->title . "\n\r";
							$msg .= "Montant: " . $amount . ",00 $\n\r";
							$msg .= "Nom du client: " . $request->get('name') . "\n\r";
							//$msg .= "Email du client:  " . $request->get('email') . "\n\r";
							Mail::raw($msg, function ($m) use ($request){
								// $m->to('developerinfo21@gmail.com')->subject("L'achat de la voiture a réussi");
								$m->to('contact@fastandretro.com')->subject("L'achat de la voiture a réussi");
							});
							$order = Orders::create([ 'card_user' => $data['name'] .' '.  $data['family_name'],
								'card_name' => $cardType, 'card' => substr($data['card'], -4), 'amount' => $amount,
								'type' => 'payzee', 'authCode' => $response->bank_resp_code, 'month_year' => $request->get('month') .'/' .$request->get('year'),
								'transId' => $response->transaction_id, 'responseCode' => $response->bank_resp_code, 'car_id' => $car->id, 
							]);
							$car->update(['status' => "booked", ]);
							return response()->json(['status' => 200, 'data' => $response, 'payment' => 'payeezy', 'order' => $order,], 200);
						}else{
							$msg  = "Le traitement du paiement a échoué pendant le processus de réservation de la voiture ". $car->id . "\n\r";
							Mail::raw($msg, function ($m) use ($request){
								// $m->to('developerinfo21@gmail.com')->subject("Échec de paiement");
								$m->to('contact@fastandretro.com')->subject("Échec de paiement");
							});
						 	return response()->json(['error' => $response, 'payment' => 'payeezy'], 405);
						}
					}catch (Payeezy_Error $e){
						$error = $e->getMessage();
						$errorType = $e->getCode();
						$success = false;
						$gatewayToken = false;
						$result = array();
						$httpStatus = $e->getJsonBody();
						$msg  = "Le traitement du paiement a échoué pendant le processus de réservation de la voiture ". $car->id . "\n\r";
						Mail::raw($msg, function ($m) use ($request){
							// $m->to('developerinfo21@gmail.com')->subject("Échec de paiement");
							$m->to('contact@fastandretro.com')->subject("Échec de paiement");
						});
						return response()->json(['failed' => $e, 'errorType' => $errorType, 'error' => $error, 'httpStatus' => $httpStatus, 'payment' => 'payeezy'], 401);
					}
				}else{
					// Common setup for API credentials
					$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
					$merchantAuthentication->setName( env('API_ID') );
					$merchantAuthentication->setTransactionKey( env('TRANSACTION_KEY') );
					// Create the payment data for a credit card
					$creditCard = new AnetAPI\CreditCardType();
					$creditCard->setCardNumber($data['card']);
					$creditCard->setExpirationDate($data['year'].'-'.$data['month']);
					$creditCard->setCardCode($data['cvv']);
					$paymentOne = new AnetAPI\PaymentType();
					$paymentOne->setCreditCard($creditCard);
					// Set the customer's Bill To address
					$customerAddress = new AnetAPI\CustomerAddressType();
					$customerAddress->setFirstName($data['name']);
					$customerData = new AnetAPI\CustomerDataType();
					$customerData->setType("individual");
					//$customerData->setEmail($data['email']);
					// Create a transaction
					$transactionRequestType = new AnetAPI\TransactionRequestType();
					$transactionRequestType->setTransactionType( "authCaptureTransaction"); 
					$amt = (int) $amount * 100;
					$transactionRequestType->setAmount($amt);
					$transactionRequestType->setBillTo($customerAddress);
					$transactionRequestType->setCustomer($customerData);
					$transactionRequestType->setPayment($paymentOne);
					$request1 = new AnetAPI\CreateTransactionRequest();
					$request1->setMerchantAuthentication($merchantAuthentication);
					$request1->setTransactionRequest( $transactionRequestType);
					$controller = new AnetController\CreateTransactionController($request1);
					$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
					if($response != null){
						if(strtolower($response->getMessages()->getResultCode()) != 'error'){
							$tresponse = $response->getTransactionResponse();
							if($tresponse != null && $tresponse->getMessages() != null){
								$msg  = "Numéro d'identification de la voiture: " . $car->id . "\n\r";
								$msg .= "Titre de la voiture: " . $car->title . "\n\r";
								$msg .= "Montant: " . $amount . ",00 $\n\r";
								$msg .= "Nom du client: " . $request->get('name') . "\n\r";
								//$msg .= "Email du client:  " . $request->get('email') . "\n\r";
								Mail::raw($msg, function ($m) use ($request){
									// $m->to('developerinfo21@gmail.com')->subject("L'achat de la voiture a réussi");
									$m->to('contact@fastandretro.com')->subject("L'achat de la voiture a réussi");
								});
								$order = Orders::create([ 'card_user' => $data['name'] .' '.  $data['family_name'],
									'card_name' => $cardType, 'card' => substr($data['card'], -4), 'type' => 'authorize', 'amount' => $amount,
									'month_year' => $request->get('month') .'/' .$request->get('year'), 'authCode' => $tresponse->getAuthCode(),
									'transId' => $tresponse->getTransId(), 'responseCode' => $tresponse->getResponseCode(), 'car_id' => $car->id,
								]);
								$car->update(['status' => "booked", ]);
								return response()->json(['Code' => $tresponse->getMessages()[0]->getCode(), 'order' => $order,], 200);
							}else{
								if($tresponse->getErrors() != null){
									return response()->json(['Errorcode' => $tresponse->getErrors()[0]->getErrorCode(), 'Errormessage' => $tresponse->getErrors()[0]->getErrorText(), 'payment' => 'authorize'], 401);
								}
							}
						}else{
							$msg  = "Le traitement du paiement a échoué pendant le processus de réservation de la voiture ". $car->id . "\n\r";
							Mail::raw($msg, function ($m) use ($request){
								// $m->to('developerinfo21@gmail.com')->subject("Échec de paiement");
								$m->to('contact@fastandretro.com')->subject("Échec de paiement");
							});
							$tresponse = $response->getTransactionResponse();
							if($tresponse != null && $tresponse->getErrors() != null){
								$code = $tresponse->getErrors()[0]->getErrorCode();
								return response()->json(['Errorcode' => $tresponse->getErrors()[0]->getErrorCode(), 'Errormessage' => $tresponse->getErrors()[0]->getErrorText(), 'payment' => 'authorize'], 401);
							}else return response()->json(['Errorcode' => $response->getMessages()->getMessage()[0]->getCode(), 'Errormessage' => $response->getMessages()->getMessage()[0]->getText(), 'payment' => 'authorize'], 401);							
						} 
					}else{
						$msg  = "Le traitement du paiement a échoué pendant le processus de réservation de la voiture ". $car->id . "\n\r";
						Mail::raw($msg, function ($m) use ($request){
							// $m->to('developerinfo21@gmail.com')->subject("Échec de paiement");
							$m->to('contact@fastandretro.com')->subject("Échec de paiement");
						});
						return response()->json(['error' => "Something went wrong!!!", 'payment' => 'authorize'], 401);
					}
				}
			}else return response()->json(['message' => 'First Create a Payment Type', 'payment' => 'authorize'], 500);        
	    }else return response()->json(['message' => 'Car Not Found'], 404);
	}

	public function postPaymentUser(Request $request){
		$validator = Validator::make($request->all(), [
			'occupation_type' => 'required',
			'civility' => 'required',
			'name' => 'required',
			'first_name' => 'required',
			'phone' => 'required',
			'zip_code' => 'required',
			'email' => 'required|email',
		]);
		if($validator->fails()) return response()->json(['error' => "validation failed!!!"], 401);
		$input = $request->all();
		$car = Car::find($input['carId']);
		$order = Orders::find($input['orderId']);
		if($car){
			if($order){
				$order->update([ 'civility' => $input['civility'], 'name' => $input['name'], 'family_name' => $input['first_name'], 'occupation_type' => $input['occupation_type'],
					'city' => $input['city'], 'zip_code' => $input['zip_code'], 'phone' => $input['phone'], 'address' => $input['address'],
					'additional_address' => $input['additional_address'], 'phone_fixed' => $input['phone_fixed'], 'building' => $input['building'],
					'staircase' => $input['staircase'], 'floor' => $input['floor'], 'door' => $input['door'], 'newsletter' => $input['newsletter'], 'email' => $input['email'],
				]);
				$occupation = ($order->occupation_type == 'professional') ? 'Professionnel' : "Particulier";
				$msg = "Numéro d'identification de la voiture: " . $car->id . "\n\r";
				$msg .= "Ad Reference: " . $car->referenceID . "\n\r";
				$msg .= "Titre De Voiture: " . $car->title . "\n\r";
				$msg .= "Marque: " . $car->brand . "\n\r";
				$msg .= "Modèle: " . $car->model . "\n\r";
				$msg .= "Prix: " . $car->price . "\n\r";
				$msg .= "Prix original: " . $car->original_price . "\n\r";
				if($car->mileage) $msg .= "Mileage: " . $car->mileage . "\n\r";
				if($car->original_url) $msg .= "Lien original: " . $car->original_url . "\n\r";
				$msg .= "Voir la voiture: " . url("/product/") . '/' . $car->id . "\n\r";
				$msg .= "Montant: " . $order->amount . ",00 $\n\r";
				$msg .= "Type d'occupation: " . $occupation . "\n\r";
				$msg .= "Civilité: " . $order->civility . "\n\r";
				$msg .= "Nom du client: " . $order->name ." ". $order->family_name. "\n\r";
				$msg .= "Email du client:  " . $order->email . "\n\r";
				$msg .= "Téléphone mobile: " . $order->phone . "\n\r";
				if($order->phone_fixed) $msg .= "Téléphone fixe: " . $order->phone_fixed . "\n\r";
				if($order->address) $msg .= "Adresse: " . $order->address . "\n\r";
				if($order->additional_address) $msg .= "Complément d’adresse: " . $order->additional_address . "\n\r";
				$msg .= "Ville: " . $order->city . "\n\r";
				$msg .= "Code postal: " . $order->zip_code . "\n\r";
				if($order->building) $msg .= "Bâtiment: " . $order->building . "\n\r";
				if($order->staircase) $msg .= "Escalier: " . $order->staircase . "\n\r";
				if($order->floor) $msg .= "Ètage: " . $order->floor . "\n\r";
				if($order->door) $msg .= "Porte: " . $order->door . "\n\r";
				Mail::raw($msg, function ($m) use ($request){
					// $m->to('developerinfo21@gmail.com')->subject("L'achat de la voiture a réussi");
					$m->to('contact@fastandretro.com')->subject("L'achat de la voiture a réussi");
				});
				Mail::send('admin.carmanager.mailView',['name' => $order->name, 'model' => $car->title, 'date' => date("d/m/Y")], function($m) use ($request, $input, $order){
				    $m->to($input['email'])->subject("L'achat de la voiture a réussi");
				});
				return response()->json(['order' => $order,], 200);
			}else return response()->json(['error' => "Order Not Found"], 400);
		}else return response()->json(['error' => "Car Not Found"], 400);	 
	}

	public function getPayment($id){
		$car = Car::find($id);
		if($car) return view('carPayment', compact('car', 'id'));
		else return redirect('/cars');
	}
}