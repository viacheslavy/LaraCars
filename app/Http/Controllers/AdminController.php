<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Contacts;
use App\GlobalPriceSetting;
use Response;

use App\Car;
use App\PriceRule;
use App\CarSite;
use App\ImageTable;
use Goutte\Client;
use Session, View, File, Log, DateTime, Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use Intervention\Image\ImageManagerStatic as Image;
use App\Make;
use App\MakeModel;
use App\Jewel;
use App\Images;
use App\CarsScraped;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use App\CarsScrapImage;
use App\Orders;

class AdminController extends Controller {

	public function getAdmin() {
		return view('admin.home');
	}

	public function getAdmins(){
		$user = Auth::user();
		$id = Auth::id();
		$admins = User::whereRaw("admin = ? AND id != ?", [1, $id])->get();
		return view('admin.addAdmin.adminsList', compact('admins'));
	}

	public function getCreateAdmin(){
		return view('admin.addAdmin.createAdmin');
	}

	public function newAdmin(Request $request){
		$this->validate($request, [
			'name' => 'required|min:3',
			'phone' => 'required|min:10',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
			'password_confirmation' => 'required|min:5|same:password'
		]);
		User::create(['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'admin' => 1, 'password' => bcrypt($request->password)]);
		return redirect("/cpanel/admins")->with('message',"Admin Created Successfully");
	}

	public function editAdmin($id){
		$admin = User::find($id);
		if($admin){
			return view('admin.addAdmin.editAdmin', compact('admin'));
		}
		return redirect("/cpanel/admins")->withErrors("User Not Found");
	}

	public function updateAdmin(Request $request, $id){
		$this->validate($request, [
			'name' => 'required|min:3',
			'email' => "required|email|unique:users,email,$id",
			'password' => 'min:6',
			'password_confirmation' => 'same:password',
			'phone' => 'required|min:10'
		]);
		$saveAdmin = User::find(Input::get('id'));
		if($saveAdmin){
			$saveAdmin->name = Input::get('name');
			$saveAdmin->email = Input::get('email');
			$saveAdmin->password = bcrypt(Input::get('password'));
			$saveAdmin->phone = Input::get('phone');
			$saveAdmin->update();
			return redirect("/cpanel/admins")->with('message',"Admin Updated Successfully");
		}
		return redirect("/cpanel/admins")->withErrors("User Not Found");   
	}

	public function deleteAdmin($id){
		$admin = User::whereRaw("id = ? AND admin = ?", [$id, 1])->first();
		if($admin){
			$admin->delete();
			return redirect("/cpanel/admins")->with('message', "User deleted Successfully");
		}else{
			return redirect("/cpanel/admins")->withErrors("User Not Found");
		}
	}

	public function getContact(){
		$contacts = Contacts::orderBy('id', 'desc')->get();
		return view('admin.contacts', compact('contacts'));
	}

	public function deleteContact($id){
		$contact = Contacts::find($id);
		if($contact){
			$contact->delete();
			return redirect('/cpanel/contact')->with('message', "Contact deleted Successfully");
		}
		return redirect('/cpanel/contact')->withErrors("Contact Not Found");
	}

	public function contactExport(){
		$headers = array(
			"Content-type" => "text/csv",
			"Content-Disposition" => "attachment; filename=contacts.csv",
			"Pragma" => "no-cache",
			"Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
			"Expires" => "0"
		);
		$contacts = Contacts::all();
		$columns = ['Email', 'Ip', 'Location', 'Latitude', 'Longitude', 'DateTime'];
		$callback = function() use($contacts, $columns){
			$file = fopen('php://output', 'w');
			fputcsv($file, $columns);
			foreach($contacts as $contact){
				fputcsv($file, [
					$contact->email,
					$contact->ip,
					$contact->address,
					$contact->latitude,
					$contact->longitude,
					date('Y-m-d H:i:s', strtotime($contact->created_at))
				]);
			}
			fclose($file);
		};
		return Response::stream($callback, 200, $headers);
	}

	public function getGatewayClassiccars(){
		$manageprices = GlobalPriceSetting::all();
		return view('admin.gatewayclassiccars', compact('manageprices'));
	}

	public function FilterSites(Request $request){
		if(!file_exists(public_path() . "/scraperJson")){ mkdir(public_path() . "/scraperJson", 0755, true); };
		$paginationCount = 0;
		$gatewayclassicJson = \App\Car::getGateWayClassicCars($request->all(), LengthAwarePaginator::resolveCurrentPage());
		if(!is_array($gatewayclassicJson)){ $gatewayclassicJson = []; }
		$gatewayclassicTotal = 1;
		$gatewayclassicPageCount = 1;
		if(count($gatewayclassicJson) > 1){
			$gatewayclassicTotal = $gatewayclassicJson[0]['total_results'];
			$gatewayclassicPageCount = $gatewayclassicJson[0]['page_count'];
		}
		if($paginationCount < $gatewayclassicPageCount){ $paginationCount = $gatewayclassicPageCount; };
		$resultJson = $gatewayclassicJson;
		$excludeBrands = array('Acura', 'Alpenlite', 'Aluma', 'Alumacraft', 'AM General', 'American Hauler', 'American Motors', 'Amphicar', 'Anderson', 'Aprilia', 'Arctic Cat', 'Baja', 'Bayliner', 'Belmont', 'Big Dog', 'Big Tex', 'Blue Bird', 'Bobcat', 'Bombardier', 'Bravo', 'Bronc', 'Buell', 'Calico', 'Can-Am', 'Cargo Mate', 'Carriage', 'Carry-On', 'Case IH', 'Caterpillar', 'CF Moto', 'Chris-Craft', 'Club Car', 'Coachmen', 'Coleman', 'Continental Cargo', 'Crossroads', 'Cub Cadet', 'Cube Van', 'Cushman', 'Daihatsu', 'Damon', 'Diamo', 'Diamond C', 'Diamond-T', 'Dixie Chopper', 'Doolittle', 'Dutchmen', 'Eagle', 'Eclipse', 'Edsel', 'Featherlite', 'Fisher', 'Fisker', 'Flagstaff', 'Four Winns', 'Freedom', 'Freightliner', 'GEM', 'Genesis', 'GEO', 'Georgie Boy', 'Glastron', 'Great Dane', 'Gulf Stream', 'H&H', 'Haulmark', 'Heartland', 'Hino', 'Holiday Rambler', 'Homesteader', 'Honda', 'Hudson', 'Husqvarna', 'Hyosung', 'Hyundai', 'IHC', 'Indian', 'Infiniti', 'International', 'Interstate', 'Isuzu', 'Itasca', 'Jay Feather', 'Jay Flight', 'Jayco', 'John Deere', 'Jonway', 'Joyner', 'Kaiser', 'Kaufman', 'Kenworth', 'Keystone', 'Kia', 'Kioti', 'Kodiak', 'Komfort', 'KTM', 'Kubota', 'Kymco', 'Lance', /*'Lancia',*/ 'Lark', 'Larson', 'Leer', 'Lexus', 'Linhai', 'Little Guy', 'Livin Lite', 'Load Trail', 'Look Trailers', 'Mack', 'Maxum', 'McLaren', 'Mercruiser', 'Merkur', 'Midsota', 'Mitsubishi', 'Monaco', 'Monterey', /*'Morgan',*/ 'Nash', 'New Holland', 'Newmar', 'Nissan', 'Nomad', /*'Opel',*/ 'Pace', 'Pace American', 'Packard', 'Palomino', 'Panoz', 'Peace Sports', 'Peterbilt', 'Peugeot', 'Phoenix', 'Piaggio', 'Pleasure-Way', 'Polaris', 'Pro-Line', 'Propel', 'Quality Steel', 'RAM', 'Regal', 'Reiser', 'Rice Trailers', 'Ridley', 'Riverside RV', 'Rockwood', 'Roketa', 'Royal Cargo', 'R-Vision', /*'Saab',*/ 'Salem', 'Saturn', 'Scion', 'Sea Ray', 'Sea-Doo', 'Skeeter', 'Ski-Doo', 'Skyline', 'Smart', 'Snapper', 'Starcraft', 'Sterling', 'Subaru', 'Sunbeam', 'Sunny Brook', 'Sure-Trac', 'Suzuki', 'Tesla', 'Thor Industries', 'Tiffin', 'Toro', 'Toyota', 'Tracker', 'Triton', 'US Cargo', 'V-Cross', 'Vespa', 'Victory', /*'Volvo',*/ 'Wabash', 'Weekend Warrior', 'Wellcraft', 'Wells Cargo', 'Wildwood', 'Winnebago', 'Xpress', 'Yamaha', 'Yugo');
		$manageprices = GlobalPriceSetting::all();
		$search = $request->all();
		$cars = \App\Car::all();
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$arr = [];
		for($i = 1; $i <= $paginationCount; $i++){ $arr[] = $i; };
		$col = new Collection($arr);
		$perPage = 1;
		$currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
		$paginator = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, LengthAwarePaginator::resolveCurrentPage(), array('path' => LengthAwarePaginator::resolveCurrentPath()));
		return view('admin.gatewayclassiccars', compact('cars', 'manageprices', 'search', 'paginationCount', 'resultJson', 'paginator', 'excludeBrands'));
	}
}