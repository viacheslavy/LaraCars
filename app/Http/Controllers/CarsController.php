<?php

namespace App\Http\Controllers;

use App\Car;
use App\PriceRule;
use App\CarSite;
use App\GlobalPriceSetting;
use App\ImageTable;
use Goutte\Client;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use View;
use Response;
use File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Make;
use App\MakeModel;
use Log;
use DateTime;
use App\Jewel;
use App\Images;
use App\CarsScraped;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Auth, Validator;
use App\CarsScrapImage;
use App\Orders;

class CarsController extends Controller
{
    public function addCarsIndex($request = NULL) {
    	$rule = PriceRule::where('default_rule', 1)->first();
	if(!$rule){ PriceRule::create([ 'start_price' => 0, 'end_price' => 0, 'price' => '8000', 'percentage' => '6', 'default_rule' => 1, ]); }

    /*    $sites = [
            [
                'url'           => 'http://www.ebay.com/sch/Cars-Trucks-/6001/i.html?_dcat=6001&_momoc=1&_rdc=1',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],
            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=2&_skc=50&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=3&_skc=100&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=4&_skc=150&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=5&_skc=200&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=6&_skc=250&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=7&_skc=300&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=8&_skc=350&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=9&_skc=400&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=10&_skc=450&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],
            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=2&_skc=50&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=3&_skc=100&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=4&_skc=150&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=5&_skc=200&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=6&_skc=250&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=7&_skc=300&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=8&_skc=350&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=9&_skc=400&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],

            [
                'url'           => 'http://www.ebay.com/sch/i.html?_nkw=Cars+Trucks&_pgn=10&_skc=450&rt=nc',
                'postWrapper'   => '.sresult',
                'title'         => '.lvtitle',
                'price'         => '.lvprice',
                'imageContainer'=> '.lvpicinner',
                'link'          => 'a.vip'
            ],
            [
                'url'           => 'https://www.carsforsale.com',
                'postWrapper'   => '.vehicle-list',
                'title'         => '.vehicle-name',
                'price'         => '.vehicle-price',
                'imageContainer'=> '.vehicle-img',
                'link'          => 'a.ellipsis'
            ],
            [
                'url'           => 'https://www.hemmings.com/classifieds/cars-for-sale',
                'postWrapper'   => '.web_result',
                'title'         => 'a.rs-headline',
                'price'         => '.class_price',
                'imageContainer'=> '.rs-img-container',
                'link'          => 'a.rs-headline'
            ]

        ];


        if($request != NULL) {
            $i = 0;

            $newSites = [];

            if($request->get('sites')) {

                foreach ($request->get('sites') as $inSite) {
                    if ($inSite == "ebay") {
                        while($i <= 9) {
                            $newSites[$i] = $sites[$i];
                            $i++;
                        }
                    }

                    if ($inSite == "carsforsale") {
                        $newSites[$i] = $sites[10];
                    }

                    if ($inSite == "hemmings") {
                        $newSites[$i] = $sites[11];
                    }

                    $i++;
                }

                $newSites['single'] = 0;

                $cars = $this->crawlCars($newSites);
            } else {
                $sites['single'] = 0;
                $cars = $this->crawlCars($sites);
            }
        } else {
            $sites['single'] = 0;
            $cars = $this->crawlCars($sites);
        }


        /** SEARCH ARRAY IF REQUESTED **/

        /* if($request != NULL) {


            $make       = $request->get('make');
            $model      = $request->get('model');
            $keyword    = $request->get('keyword');
            $year       = $request->get('year');



            // Search title.
            $results = array_filter($array, function ($el) use ($make) {
                return (strpos(strtolower($el['title']), strtolower($make)) !== false);
            });

            // Search model.
            $results = array_filter($results, function ($el) use ($model) {
                return (strpos(strtolower($el['title']), strtolower($model)) !== false);
            });

            // Search keyword.
            $results = array_filter($results, function ($el) use ($keyword) {
                return (strpos(strtolower($el['title']), strtolower($keyword)) !== false);
            });


             // Convert object to array because of search.
             $array = json_decode(json_encode($cars), true);

             $make       = $request->get('make');
             $keyword    = $request->get('keyword');
             $year       = $request->get('year');




             // Search title.
             $results = array_filter($array, function ($el) use ($make) {
                 return (strpos(strtolower($el['title']), strtolower($make)) !== false);
             });


             // Search keyword.
             $results = array_filter($results, function ($el) use ($keyword) {
                 return (strpos(strtolower($el['title']), strtolower($keyword)) !== false);
             });

             // Search year.
             $results = array_filter($results, function ($el) use ($year) {
                 return (strpos(strtolower($el['title']), strtolower($year)) !== false);
             });


             // Converting array to object.
             $brand_new_arr = [];

             foreach ($results as $result) {
                 $brand_new_arr[] = (object)$result;
             }


        }



             $searchResults = (object)$brand_new_arr;

             $cars = $searchResults;


         }


        /** END OF SEARCH **/

        $cars ='';

        $manageprices = GlobalPriceSetting::all();
        $makedetails = DB::table('makes')->get();

        return view('admin.carmanager.addcars', compact('cars', 'manageprices', 'makedetails'));
    }

    public function createCar(){
        $makedetails = DB::table('makes')->get();
        return view('admin.carmanager.newcar', compact('makedetails'));
    }

    public function FilterSitess(Requests\CarsFilterRequest $request) {

        $data = $request->all();

        $years = "";

        if($data['year1'] != "" && $data['year2'] != "") {
            for($i = intval($data['year1']); $i <= $data['year2']; $i++) {
                $years .= $i . "|";
            }
        } else {
            for($i = 1901; $i <= 1986; $i++) {
                $years .= $i;
                if($i != 1986)
                    $years .= "|";
            }
        }



        Session::put('backUrl',$request->fullUrl().'&back');



        $ebay =   [
            'url'           => 'http://www.ebay.com/sch/Cars-Trucks/6001/i.html?_from=R40&_dcat=6001&Model%2520Year='.urlencode($years).'&_dmpt=US_Cars_Trucks&makeval='.urlencode($data['make']).'&modelval='.urlencode($data['model']).'&_nkw='.urlencode($data['make'].''.$data['model']).'&Exterior%2520Color='.urlencode($data['color']).'&_ipg=1000&Mileage='.urlencode('Less than'. $data['miles'].'miles').'rt=nc&_udlo=' . urlencode($data['price1']) . '&_udhi=' . urlencode($data['price2']) . '&LH_BIN=1',
            'postWrapper'   => '.sresult',
            'title'         => '.lvtitle',
            'price'         => '.lvprice',
            'imageContainer'=> '.imgWr2',
            'link'          => 'a.vip'
        ];

  /*      $ebay2 =   [
            'url'           => 'http://www.ebay.com/sch/Cars-Trucks/6001/i.html?_from=R40&_dcat=6001&Model%2520Year='.urlencode($years).'&_dmpt=US_Cars_Trucks&makeval='.urlencode($data['make']).'&modelval='.urlencode($data['model']).'&_nkw='.urlencode($data['make'].''.$data['model']).'&Exterior%2520Color='.urlencode($data['color']).'&_ipg=1000&rt=nc&_udlo=' . urlencode($data['price1']) . '&_udhi=' . urlencode($data['price2']) . '&LH_BIN=1&_pgn=2',
            'postWrapper'   => '.sresult',
            'title'         => '.lvtitle',
            'price'         => '.lvprice',
            'imageContainer'=> '.imgWr2',
            'link'          => 'a.vip'
        ];*/

 /*       $ebay3 =   [
            'url'           => 'http://www.ebay.com/sch/Cars-Trucks/6001/i.html?_from=R40&_dcat=6001&Model%2520Year='.urlencode($years).'&_dmpt=US_Cars_Trucks&makeval='.urlencode($data['make']).'&modelval='.urlencode($data['model']).'&_nkw='.urlencode($data['make'].''.$data['model']).'&Exterior%2520Color='.urlencode($data['color']).'&_ipg=200&rt=nc&_udlo=' . urlencode($data['price1']) . '&_udhi=' . urlencode($data['price2']) . '&LH_BIN=1&_pgn=3',
            'postWrapper'   => '.sresult',
            'title'         => '.lvtitle',
            'price'         => '.lvprice',
            'imageContainer'=> '.imgWr2',
            'link'          => 'a.vip'
        ];

        $ebay4 =   [
            'url'           => 'http://www.ebay.com/sch/Cars-Trucks/6001/i.html?_from=R40&_dcat=6001&Model%2520Year='.urlencode($years).'&_dmpt=US_Cars_Trucks&makeval='.urlencode($data['make']).'&modelval='.urlencode($data['model']).'&_nkw='.urlencode($data['make'].''.$data['model']).'&Exterior%2520Color='.urlencode($data['color']).'&_ipg=200&rt=nc&_udlo=' . urlencode($data['price1']) . '&_udhi=' . urlencode($data['price2']) . '&LH_BIN=1&_pgn=4',
            'postWrapper'   => '.sresult',
            'title'         => '.lvtitle',
            'price'         => '.lvprice',
            'imageContainer'=> '.imgWr2',
            'link'          => 'a.vip'
        ];

        $ebay5 =   [
            'url'           => 'http://www.ebay.com/sch/Cars-Trucks/6001/i.html?_from=R40&_dcat=6001&Model%2520Year='.urlencode($years).'&_dmpt=US_Cars_Trucks&makeval='.urlencode($data['make']).'&modelval='.urlencode($data['model']).'&_nkw='.urlencode($data['make'].''.$data['model']).'&Exterior%2520Color='.urlencode($data['color']).'&_ipg=200&rt=nc&_udlo=' . urlencode($data['price1']) . '&_udhi=' . urlencode($data['price2']) . '&LH_BIN=1&_pgn=5',
            'postWrapper'   => '.sresult',
            'title'         => '.lvtitle',
            'price'         => '.lvprice',
            'imageContainer'=> '.imgWr2',
            'link'          => 'a.vip'
        ];*/



        $carsforsale1 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice' . urlencode($data['price1']) . '=&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

        $carsforsale2 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=2',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

         $carsforsale3 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=3',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

           $carsforsale4 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=4',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

           $carsforsale5 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=5',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

           $carsforsale6 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=6',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

           $carsforsale7 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=7',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

              $carsforsale8 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=8',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

              $carsforsale9 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=9',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];

              $carsforsale10 = [
           'url'           => 'https://www.carsforsale.com/Search?BodyStyle=All+Vehicle+Types&Make='.urlencode($data['make']).'&Model='.urlencode($data['model']).'&MinModelYear='.urlencode($data['year1']).'&MaxModelYear='.urlencode($data['year2']).'&MinPrice=' . urlencode($data['price1']) . '&MaxPrice=' . urlencode($data['price2']) . '&MaxMileage=' . urlencode($data['miles']) . '&ZipCode=&Radius=1000&PageNumber=10',
           'postWrapper'   => '.vehicle-list',
           'title'         => '.vehicle-name',
           'price'         => '.vehicle-price',
           'imageContainer'=> '.vehicle-img',
           'link'          => 'a.ellipsis'

       ];


       $hemmings1 = ['url' =>'https://www.hemmings.com/classifieds/?0=0&makeFacet='.urlencode($data['make']).'&adtypeFacet=Vehicles%20for%20Sale&year_min='.urlencode($data['year1']).'&year_max='.urlencode($data['year2']).'&modelFacet='.urlencode($data['model']).'&sort=sort_time_desc&page_size=60',
            'postWrapper'   => '.web_result',
            'title'         => 'a.rs-headline',
            'price'         => '.class_price',
            'imageContainer'=> '.rs-img-container',
            'link'          => 'a.rs-headline'


       ];

       $autotraderFeatured = ['url' =>'http://www.autotrader.com/cars-for-sale/'.urlencode($data['make']).'/Agoura+Hills+CA-91301?zip=91301&showcaseOwnerId=1363897&startYear=1981&maxMileage=100000&minPrice=' . urlencode($data['price1']) . '&maxPrice=' . urlencode($data['price2']) . '&extColorsSimple='.strtoupper(urlencode($data['color'])).'&firstRecord=0&endYear=1986&searchRadius=0&numRecords=100',
            'postWrapper'   => 'div[data-qaid="cntnr-lstng-featured"]',
            'title'         => 'h2',
            'price'         => '[data-qaid="cntnr-lstng-price1"]',
            'imageContainer'=> '.image-inventory div',
            'link'          => 'h2 a'


       ];

        $autotraderPremium = ['url' =>'http://www.autotrader.com/cars-for-sale/'.urlencode($data['make']).'/Agoura+Hills+CA-91301?zip=91301&showcaseOwnerId=1363897&startYear=1981&maxMileage=100000&minPrice=' . urlencode($data['price1']) . '&maxPrice=' . urlencode($data['price2']) . '&extColorsSimple='.strtoupper(urlencode($data['color'])).'&firstRecord=0&endYear=1986&searchRadius=0&numRecords=100',
            'postWrapper'   => 'div[data-qaid="cntnr-lstng-premium"]',
            'title'         => 'h2',
            'price'         => '[data-qaid="cntnr-lstng-price1"]',
            'imageContainer'=> '.image-inventory div',
            'link'          => 'h2 a'


       ];

        if(isset($data['sites'])) {

            foreach ($data['sites'] as $site) {

                if ($site == 'ebay') {

                    $sites[] = $ebay;
                   /* $sites[] = $ebay2;
                    $sites[] = $ebay3;
                    $sites[] = $ebay4;
                    $sites[] = $ebay5;*/
                }

                if ($site == 'carsforsale') {

                    $sites[] = $carsforsale1;
                    $sites[] = $carsforsale2;
                    $sites[] = $carsforsale3;
                    $sites[] = $carsforsale4;
                    $sites[] = $carsforsale5;
                    $sites[] = $carsforsale6;
                    $sites[] = $carsforsale7;
                    $sites[] = $carsforsale8;
                    $sites[] = $carsforsale9;
                    $sites[] = $carsforsale10;

                }

                if ($site == 'hemmings') {

                    $sites[] = $hemmings1;

                }

                if ($site == 'autotrader') {

                    $sites[] = $autotraderFeatured;
                    $sites[] = $autotraderPremium;
                }
            }
        }

        if(empty($sites)) {

            $sites[0] = $ebay;
       /*     $sites[1] = $ebay2;
            $sites[2] = $ebay3;
            $sites[3] = $ebay4;
            $sites[4] = $ebay5;*/
            $sites[5] = $carsforsale1;
        }


        $sites['single'] = 0;


        if ( isset($_GET['back']) ) {

           $cars = Session::get('cars');
        }

        else {


            $cars = $this->crawlCars($sites);
            Session::put('cars', $cars);

        }

        $manageprices = GlobalPriceSetting::all();
        return view('admin.carmanager.addcars', compact('cars', 'manageprices'));
    }

	public function FilterSites(Request $request){ 
		if(!file_exists(public_path() . "/scraperJson")){ mkdir(public_path() . "/scraperJson", 0755, true); };
		if($request->has('sites') && !empty($request->get('sites'))){ 
			$sites = $request->get('sites');
			$resultJson = [];
			$paginationCount = 0;
			if(in_array("carsforsale", $sites)){
				$carsforsaleJson = \App\Car::getCarsforsale($request->all(), LengthAwarePaginator::resolveCurrentPage());
				if(!is_array($carsforsaleJson)){ $carsforsaleJson = []; }
				$carsforsaleTotal = 1;
				$carsforsalePageCount = 1;
				if(count($carsforsaleJson) > 1){
					$carsforsaleTotal = $carsforsaleJson[0]['total_results'];
					$carsforsalePageCount = $carsforsaleJson[0]['total_pages'];
				}
				if($paginationCount < $carsforsalePageCount){ $paginationCount = $carsforsalePageCount; };
				$resultJson = array_merge($carsforsaleJson, $resultJson);
			}
			if(in_array("ebay", $sites)){
				$ebayJson = \App\Car::getEbay($request->all(), LengthAwarePaginator::resolveCurrentPage());
				if(!is_array($ebayJson)){ $ebayJson = []; } 
				$ebayTotal = 1;
				$ebayPageCount = 1;
				if(count($ebayJson) > 1){
					$ebayTotal = $ebayJson[0]['total_results'];
					$ebayPageCount = $ebayJson[0]['page_count'];
				}
				if($paginationCount < $ebayPageCount){ $paginationCount = $ebayPageCount; };
				$resultJson = array_merge($ebayJson, $resultJson); 
			}
			if(in_array("hemmings", $sites)){
				$hemmingJson = \App\Car::getHemmings($request->all(), LengthAwarePaginator::resolveCurrentPage());
				if(!is_array($hemmingJson)){ $hemmingJson = []; }
				$hemmingTotal = 1;
				$hemmingPageCount = 1;
				if(count($hemmingJson) > 1){
					$hemmingTotal = $hemmingJson[0]['total_results'];
					$hemmingPageCount = $hemmingJson[0]['page_count'];
				}
				if($paginationCount < $hemmingPageCount){ $paginationCount = $hemmingPageCount; };
				$resultJson = array_merge($hemmingJson, $resultJson);
			}
			if(in_array("gatewayclassiccars", $sites)){
				$gatewayclassicJson = \App\Car::getGateWayClassicCars($request->all(), LengthAwarePaginator::resolveCurrentPage());
				if(!is_array($gatewayclassicJson)){ $gatewayclassicJson = []; }
				$gatewayclassicTotal = 1;
				$gatewayclassicPageCount = 1;
				if(count($gatewayclassicJson) > 1){
					$gatewayclassicTotal = $gatewayclassicJson[0]['total_results'];
					$gatewayclassicPageCount = $gatewayclassicJson[0]['page_count'];
				}
				if($paginationCount < $gatewayclassicPageCount){ $paginationCount = $gatewayclassicPageCount; };
				$resultJson = array_merge($gatewayclassicJson, $resultJson);
			}
		}else{
			$ebayJson = \App\Car::getEbay($request->all(), LengthAwarePaginator::resolveCurrentPage());
			if(!is_array($ebayJson)){ $ebayJson = []; }
			$ebayTotal = 1;
			$ebayPageCount = 1;
			if(count($ebayJson) > 1){
				$ebayTotal = $ebayJson[0]['total_results'];
				$ebayPageCount = $ebayJson[0]['page_count'];
			}
			$carsforsaleJson = \App\Car::getCarsforsale($request->all(), LengthAwarePaginator::resolveCurrentPage());
			if(!is_array($carsforsaleJson)){ $carsforsaleJson = []; }
			$carsforsaleTotal = 1;
			$carsforsalePageCount = 1;
			if(count($carsforsaleJson) > 1){
				$carsforsaleTotal = $carsforsaleJson[0]['total_results'];
				$carsforsalePageCount = $carsforsaleJson[0]['total_pages'];
			}
			$hemmingJson = \App\Car::getHemmings($request->all(), LengthAwarePaginator::resolveCurrentPage());
			if(!is_array($hemmingJson)){ $hemmingJson = []; }
			$hemmingTotal = 1;
			$hemmingPageCount = 1;
			if(count($hemmingJson) > 1){
				$hemmingTotal = $hemmingJson[0]['total_results'];
				$hemmingPageCount = $hemmingJson[0]['page_count'];
			}
			$gatewayclassicJson = \App\Car::getGateWayClassicCars($request->all(), LengthAwarePaginator::resolveCurrentPage());
			if(!is_array($gatewayclassicJson)){ $gatewayclassicJson = []; }
			$gatewayclassicTotal = 1;
			$gatewayclassicPageCount = 1;
			if(count($gatewayclassicJson) > 1){
				$gatewayclassicTotal = $gatewayclassicJson[0]['total_results'];
				$gatewayclassicPageCount = $gatewayclassicJson[0]['page_count'];
			}
			$resultJson = array_merge($carsforsaleJson, $ebayJson, $hemmingJson, $gatewayclassicJson);
			$paginationCount = $ebayPageCount;
			if($ebayPageCount < $carsforsalePageCount && $hemmingPageCount < $carsforsalePageCount){ $paginationCount = $carsforsalePageCount; };
			if($ebayPageCount < $hemmingPageCount && $carsforsalePageCount < $hemmingPageCount){ $paginationCount = $hemmingPageCount; };
		}
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
		return view('admin.carmanager.addcars_new', compact('cars', 'manageprices', 'search', 'paginationCount', 'resultJson', 'paginator', 'excludeBrands'));
	}

    public function crawlCars($sites) {


        ini_set('max_execution_time', 0);
        $client = new Client();

        $single = $sites['single'];


        unset($sites['single']);

        foreach($sites as $site) {

            $url = $site['url'];
            $postWrapper = $site['postWrapper'];
            $title = $site['title'];
            $price = $site['price'];
            $image = $site['imageContainer'];
            $link1 = $site['link'];
            $image2 = $site['imageContainer'];

             if(strpos($url, 'hemmings') !== false) {

                $config = [
                'proxy' => [
                'http' => '97.77.104.22:3128'
                ]
                ];

               $client->setClient(new \GuzzleHttp\Client($config));
                //set headers for hemmings
               $client->setHeader('User-Agent', "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36");
               $client->setHeader('Accept-Encoding', "gzip, deflate, sdch, br");
               $client->setHeader('upgrade-insecure-requests', "0");
               $client->setHeader('cache-control', "no-cache");
               /*$client->setHeader('referer', "https://www.hemmings.com/");*/
               $client->setHeader('accept','text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8');

              $client->setHeader('cookie','PHPSESSID=mkkfmsjg72932rcf0b294rl454; U=1040464261585bc4d39e6e5b6133e0; visid_incap_984766=mD6RXcE0Q9qcwlT/XkJw0dLEW1gAAAAAQUIPAAAAAACScxde9hU0KqfkFnqEt0M8; incap_ses_417_984766=y+LTK1t03l+LsoBi9HvJBdPEW1gAAAAAUiC67UyyNfzLvqzdSum4Vg==; __gads=ID=c39136011fb4db02:T=1482409175:S=ALNI_MZHcrd8EN5k7uHfK2nNNcb5HET9dQ;');


             }



            $crawler = $client->request('GET', $url);

            $siteUrlForReference = $url;

            $posts[] = $crawler->filter($postWrapper)->each(function ($post) use($title, $price, $image, $link1,$siteUrlForReference, $single, $image2, $postWrapper, $client) {


                $post = new Crawler($post->html());

                // GET LINK
                $link = $post->filter($link1)->each(function ($elem) {
                    return $elem->attr('href');
                });

                // GET TITLE
                $title = $post->filter($title)->each(function ($elem) use($siteUrlForReference) {
                    return trim(str_replace('New listing', ' ', preg_replace('/\s\s+/', ' ', $elem->text())));
                });


                // GET PRICE
                $price = $post->filter($price)->each(function ($elem) use($siteUrlForReference) {

                    if(strpos($siteUrlForReference, 'carsforsale') !== false) {

                        $myPrice = trim(preg_replace('/\s\s+/', ' ', $elem->text()));
                        $myPrice = explode(' $', $myPrice);
                        $myPrice = $myPrice[0];

                    } else if(strpos($siteUrlForReference, 'ebay') !== false) {
                        $myPrice = $elem->text();

                    } else if(strpos($siteUrlForReference, 'hemmings') !== false) {
                        $myPrice = $elem->text();
                    }

                    else if(strpos($siteUrlForReference, 'autotrader') !== false) {
                        $myPrice = $elem->text();
                    }

                    $myPrice = trim(preg_replace('/[^0-9\-]/', '', (preg_replace('/\s\s+/', ' ', $myPrice))));

                    if(strpos($siteUrlForReference, 'ebay') !== false) {
                        $myPrice = substr(trim(preg_replace('/[^0-9\-]/', '', (preg_replace('/\s\s+/', ' ', $elem->text())))), 0, -2);
                    }

                    return $myPrice;
                });



                // GET THUMBNAIL LISTING IMAGE
                if($single == 0) {

                    $linkInner = $link;

                    if(isset($linkInner[0])) {
                        $linkInner = $linkInner[0];
                    } else {
                        $linkInner = "";
                    }

                    $carLink2 = $linkInner;

                    if (strpos($carLink2, 'ebay') !== false) {

                        $splited2 = explode('/', $carLink2);
                        $newLink2 = "http://www.ebay.com/itm/" . $splited2[4] . "/" . $splited2[5];

                        $crawleri = $client->request('GET', $newLink2);

                        $postsi[] = $crawleri->filter("#Body")->each(function ($posti) {

                            $posti = new Crawler($posti->html());

                            //Ebay get images
                            $single_images = $posti->filter('.tdThumb img')->each(function ($elemi) {
                                return $elemi->attr('src');
                            });

                            $imgUrlsMedium = '';

                            if (!empty($single_images)) {
                                foreach ($single_images as $img) {
                                    $imgUrlsMedium[] = str_replace("s-l64.jpg", "s-l500.jpg", $img);
                                    break;
                                }
                            }


                            return $imgUrlsMedium;

                        });


                        if(isset($postsi[0])) {
                            $someArray = $postsi[0];
                            if(isset($someArray[0])) {
                                $anotherArray = $someArray[0];
                                if(isset($anotherArray[0])) {
                                    $image = $anotherArray[0];
                                } else {
                                    $image = $anotherArray;
                                }
                            }
                        }

                        $image = [$image];


                    }
                     elseif ( strpos($carLink2, '/cars-for-sale/vehicledetails.xhtml') !== false ) {

                         $image = $this->getAutoTraderThumbImage($link);
                     }
                     else {
                        $image = $post->filter($image)->each(function ($elem) {
                            $img = new Crawler($elem->html());
                            return $img->filter('img')->attr('src');
                        });
                    }


                    /*$image = $post->filter($image)->each(function ($elem) {
                        $img = new Crawler($elem->html());
                        return $img->filter('img')->attr('src');
                    });*/



                } else {

                    $image = $post->filter($image2)->each(function ($elem) {
                        return $elem->attr('src');
                    });

                    $model = $post->filter('h2[itemprop="model"]')->each(function ($elem) {
                        return $elem->text();

                    });


                }


                if(isset($image[0])) {
                    $image = $image[0];
                } else {
                    $image = "";

                }

                if(isset($title[0])) {
                    $title = $title[0];
                } else {
                    $title = "";
                }

                if(isset($link[0])) {
                    $link = $link[0];
                } else {
                    $link = "";
                }

                if(isset($price[0])) {
                    $price = $price[0];
                } else {
                    $price = "";
                }

                $referenceID = "";



                if($single == 1) {
                    $exLink = $siteUrlForReference;
                } else {
                    $exLink = $link;
                }


                // GET REFERENCE IDs from Links

                if (strpos($siteUrlForReference, 'ebay') !== false) {
                    $linkExploded = explode('/', $exLink);
                    $linkExploded = explode('?', $linkExploded[5]);
                    $referenceID = $linkExploded[0];
                    $sourceSite = 'Ebay';
                }
                if (strpos($siteUrlForReference, 'carsforsale') !== false) {
                    $linkExploded = explode('/', $exLink);
                    if ( isset($linkExploded[3]) )
                    if ( $single == 1 ) {
                       $referenceID = $linkExploded[5];
                    }
                    $sourceSite = 'Cars For Sale';
                }
                if (strpos($siteUrlForReference, 'hemmings') !== false) {
                    $linkExploded = explode('/', $exLink);
                    if ( isset($linkExploded[7]) ) {
                    $linkExploded = explode('.', $linkExploded[7]);
                    $referenceID = $linkExploded[0];
                    }
                    else {
                    $linkExploded = explode('.', $linkExploded[5]);
                    $referenceID = $linkExploded[0];
                    }
                    $sourceSite = 'Hemmings';
                }
                  if (strpos($siteUrlForReference, 'autotrader') !== false) {
                    $exLink = 'http://www.autotrader.com'.$exLink;
                    $query = parse_url($exLink, PHP_URL_QUERY);
                    parse_str($query, $params);
                    $referenceID = $params['listingId'];
                    $sourceSite = 'Autotrader';
                }




                 //set vars for car details

                $mileage ='';
                $year ='';
                $model ='';
                $body='';
                $transmission ='';
                $engine ='';
                $imgUrlsBig ='';
                $imgUrlsMedium='';



                 // GET DESCRIPTION  AND ATTRIBUTES SINGLE
                if ( $single == 1 ) {

                    //EBAY
                    ///////////////////////////////////////////

                    if ( $sourceSite == 'Ebay' ) {

                        $attributes = $post->filter('.itemAttr table')->each(function ($elem) {
                            return  $elem->text();
                        });

                        if ( count($attributes) > 1 ) {

                            $attrData  = $attributes[1];
                        }

                         if ( count($attributes) == 1 ) {

                            $attrData  = $attributes[0];
                        }

                    //get mileage ebay
                        $arr = explode('Mileage:', $attrData);

                        if ( isset($arr[1] ) )
                            $mileage = explode(' ', $arr[1]);
                        if (isset($mileage[2]))
                            $mileage = trim($mileage[2]);

                   //get year  ebay
                        $arr = explode('Year:', $attrData);

                        if ( isset($arr[1] ) )
                            $year = explode(' ', $arr[1]);
                        if (isset($year[2]))
                            $year = trim($year[2]);

                    //get model  ebay
                        $arr = explode('Model:', $attrData);

                        if ( isset($arr[1] ) )
                            $model = explode(' ', $arr[1]);
                        if (isset($model[2]))
                            $model = trim($model[2]);

                        $arr = explode('Body Type:', $attrData);

                        if ( isset($arr[1] ) )
                            $body = explode(' ', $arr[1]);

                        if (isset($body[2]))
                            $body = trim($body[2]);

                    //get transimission ebay
                        $arr = explode('Transmission:', $attrData);

                        if ( isset($arr[1] ) )
                            $transmission = explode(' ', $arr[1]);
                        if (isset($transmission[2]))
                            $transmission = trim($transmission[2]);

                    //get engine ebay
                        $arr = explode('Engine:', $attrData);

                        if ( isset($arr[1] ) )
                            $engine = explode(' ', $arr[1]);
                        if (isset($engine[2]))
                            $engine= trim($engine[2]);

                       //Ebay get images
                        $single_images = $post->filter('.tdThumb img')->each(function ($elem) {
                            return  $elem->attr('src');
                        });

                        $imgUrlsBig ='';
                        $imgUrlsMedium='';

                        if ( !empty($single_images) ) {

                           foreach ($single_images as $img) {

                               $imgUrlsBig[] = str_replace("s-l64.jpg","s-l1600.jpg",$img);
                               $imgUrlsMedium[] = str_replace("s-l64.jpg","s-l500.jpg",$img);

                           }

                       }

                        $description =  $post->filter('#desc_ifr')->each(function ($elem) {

                        return  $elem->attr('src');

                       });

                   }

                   else {

                       $attributes ='';

                   }

                 //CARS FOR SALE
                //////////////////////////////////////////////////

                   if ( $sourceSite == 'Cars For Sale' ) {

                     $sinlgTitle = $post->filter('.vehicle-title h1')->each(function ($elem) {
                            return  $elem->text();
                        });

                     $expldSingleTitle = explode(' ',trim($sinlgTitle[0]));

                     $year =  $expldSingleTitle[0];
                     $make =  $expldSingleTitle[1];
                     $model =  $expldSingleTitle[2];

                     $attributes = $post->filter('.vehicle-tablecell')->each(function ($elem) {
                            return  $elem->text();
                        });

                    $i = 0;

                    foreach ($attributes as $v) {

                        if ( $v == 'Mileage') {

                              $mileage = explode(' ', trim($attributes[$i+1]));
                              $mileage = $mileage[0];

                        }

                         if ( $v == 'Transmission') {

                             $transmission = explode(' ', trim($attributes[$i+1]));
                             $transmission = $transmission[0];

                        }

                         if ( $v == 'Engine') {

                             $engine = explode(' ', trim($attributes[$i+1]));
                             $engine = $engine[0];

                        }

                     $i++;
                    }

                    $mainImage = $post->filter('.item img')->each(function ($elem) {
                            return  $elem->attr('src');
                        });

                     $images = $post->filter('.item img')->each(function ($elem) {
                            return  $elem->attr('lazy-src');
                        });

                     foreach ($mainImage as $img) {

                        if ( !empty($img) ) {

                            $imageString = file_get_contents($img);

                            $imageName = explode("/", $img);

                            $imageName = $imageName[count($imageName) - 1];
                            $imageName = explode(".", $imageName);

                            $imageName = $imageName[count($imageName) - 2];

                            $imageName .= ".jpg";

                            file_put_contents(public_path() . "/uploads/" . $imageName, $imageString);

                              $imgUrlsMedium[] = asset("/uploads/" . $imageName);
                              $imgUrlsBig[] = asset("/uploads/" . $imageName);

                        }

                     }

                     foreach ($images as $img) {

                         if($img) {

                             $imageString = file_get_contents($img);

                             $imageName = explode("/", $img);

                             $imageName = $imageName[count($imageName) - 1];
                             $imageName = explode(".", $imageName);

                             $imageName = $imageName[count($imageName) - 2];

                             $imageName .= ".jpg";

                             file_put_contents(public_path() . "/uploads/" . $imageName, $imageString);

                             $imgUrlsMedium[] = asset("/uploads/" . $imageName);
                             $imgUrlsBig[] = asset("/uploads/" . $imageName);
                         }
                     }

                   }

                    /////////HEMMINGS//////////////////

                    if ( $sourceSite == 'Hemmings' ) {

                        $sinlgTitle = $post->filter('.listing-title')->each(function ($elem) {
                            return  $elem->text();
                        });

                       $expldSingleTitle = explode(' ',trim($sinlgTitle[0]));

                       $year =  $expldSingleTitle[0];
                       $make =  $expldSingleTitle[1];
                       $model =  $expldSingleTitle[2];

                       $description =  $post->filter('#listing-description-details')->each(function ($elem) {

                         return  $elem->text();

                         });

                   }

                    if ( $sourceSite == 'Autotrader' ) {

                       $expldSingleTitle = explode(' ',trim($title));

                       $year =   $expldSingleTitle[1];
                       $make =   $expldSingleTitle[2];
                       $model =  $expldSingleTitle[3];


                       //get autotrader mileage
                       $mileage = $post->filter('.row span span span')->each(function ($elem) {
                            return  $elem->text();
                        });

                        $mileage = $mileage[2];

                        //get autotrader engine and transmission

                        $descData = $post->filter('.padding-collapse-right .text-bold')->each(function ($elem) {
                            return  $elem->text();
                        });

                        $engine = $descData[0];
                        $transmission = $descData[1];

                        $imgsHtml = $post->filter('.filmstrip-slide')->each(function ($elem) {
                            return  $elem->html();
                        });

                        $matches = array();
                        $txt = '';

                        foreach ($imgsHtml as $img) {
                            $txt .= $img;
                         }

                        preg_match_all( '/src="([^"]+)"/', $txt, $matches);

                        foreach ($matches[1] as $match) {

                            $img = str_replace('/scaler/80/60', '', $match);


                            if ( strpos($img, '/resources/img/components/') === false ) {

                                    $imageString = file_get_contents($img);

                                     $imageName = explode("/", $img);

                                     $imageName = $imageName[count($imageName) - 1];
                                     $imageName = explode(".", $imageName);

                                     $imageName = $imageName[count($imageName) - 2].'-'.uniqid();

                                     $imageName .= ".jpg";

                                     file_put_contents(public_path() . "/uploads/" . $imageName, $imageString);

                                     $imgUrlsMedium[] = asset("/uploads/" . $imageName);
                                     $imgUrlsBig[] = asset("/uploads/" . $imageName);

                           }
                        }



                    }

               }


                if(Car::where('referenceID', $referenceID)->count()) {
                    $loaded = "Loaded";
                } else {
                    $loaded = "Not Loaded";
                }



                $post = [
                    'title'         => $title,
                    'price'         => $price,
                    'image'         => $image,
                    'link'          => $link,
                    'referenceID'   => $referenceID,
                    'loaded'        => $loaded,
                    'sourceSite'    => $sourceSite,

                ];

                if($single == 1) {
                    $post['model'] = $model;
                   /* $post['attributes'] = $attributes[0];*/
                    $post['mileage'] = $mileage;
                    $post['body'] = $body;
                    $post['engine'] = $engine;
                    $post['transmission'] = $transmission;
                    $post['year'] = $year;
                    $post['imgUrlsMedium'] = $imgUrlsMedium;
                    $post['imgUrlsBig'] = $imgUrlsBig;
                    $post['fullUrl'] = $siteUrlForReference;

                }


                return (object) $post;

            });



        }


        $mergeUs = [];

        if(isset($posts[1])) {
            $mergeUs = array_merge($posts[0], $posts[1]);

            for($i = 2; $i < count($posts); $i++) {
                if(isset($posts[$i])) {
                    $mergeUs = array_merge($mergeUs, $posts[$i]);
                }
            }
        } else {
            $mergeUs = $posts[0];
        }



        return (object) $mergeUs;
    }

    public function makeCarsIndex(){
        //$makedetails = Make::all();
        $makedetails = DB::table('makes')->get();
        return view('admin.carmanager.makelist', compact('makedetails'));
    }

    public function newMakeCarsIndex(){
        return view('admin.carmanager.newmakes');
    }

    public function createmakesCarsIndex(Request $request){
        $make = new Make();
        $make->name = $request->name;
        $make->status = $request->status;
        $make->save();
        return redirect()->route('get.make.cars');
    }

    public function updatemakesCarsIndex(Request $request){
        $makedetails = Make::find(Input::get('id'));
        if($makedetails){
            $makedetails->name = Input::get('name');
            $makedetails->status = Input::get('status');
            $makedetails->update();
            return redirect('/cpanel/cars/make')->with('message', "Make Updated Successfully");
        }else{
            return view('admin.carmanager.makelist', compact('makedetails'));
        }
    }

    public function deleteMakeCarsIndex($id){
        $deletemake = Make::find($id);
        if($deletemake){
            \App\MakeModel::where("make_id", $id)->delete();
            $deletemake->delete();
            return redirect('/cpanel/cars/make')->with('message', "Make deleted Successfully");
        }else{
            return redirect('/cpanel/cars/make')->withErrors("Make Not Found");
        }
    }

    public function editMakeCarsIndex($id){
        $makedetails = Make::where('id', '=', $id)->first();
        if($makedetails){
            return view('admin.carmanager.editmake', compact('makedetails')); 
        }else{
            return redirect('/cpanel/cars/make')->withErrors("Make Not Found");
        }
    }

    public function modelCarsIndex(){
        $modelsdetails = DB::table('models')->get();
        return view('admin.carmanager.modelList', compact('modelsdetails'));
    }

    public function newModelCarsIndex(){
        $makes = Make::where("status", "=", 1)->get()->pluck('name', 'id');
        if($makes){
            return view('admin.carmanager.newModel', [ 'makes' => $makes ]);
        }else{
            $makes = [];
            return view('admin.carmanager.newModel', [ 'makes' => $makes ]);
        }     
    }

    public function createModelCarsIndex(Request $request){
        $model = new MakeModel();
        $model->name = $request->name;
        $model->value = $request->value;
        $model->make_id = $request->make_id;
        $model->status = $request->status;
        $model->save();
        return redirect()->route('get.model.cars');
    }

    public function editModelCarsIndex($id){
        $makes = Make::where("status", "=", 1)->get()->pluck('name', 'id');
        $modeldetails = MakeModel::where('id', '=', $id)->first();
        if($modeldetails){  return view('admin.carmanager.editModel',
            ['modeldetails' => $modeldetails, 'makes' => $makes] ); 
        }else{ redirect()->route('get.model.cars'); }
    }

    public function updatemodelCarsIndex(){
        $modeldetails = MakeModel::find(Input::get('id'));
        if($modeldetails){
            $modeldetails->name = Input::get('name');
            $modeldetails->value = Input::get('value');
            $modeldetails->make_id = Input::get('make_id');
            $modeldetails->status = Input::get('status');
            $modeldetails->update();
            return redirect('/cpanel/cars/model')->with('message', "Model updated Successfully");
        }else{
            return view('admin.carmanager.modelList', compact('modeldetails'));
        }
    }

    public function deleteModelCarsIndex($id){
        $deletemodel = MakeModel::whereRaw("id = ?", [$id])->first();
        if($deletemodel){
            $deletemodel->delete();
            return redirect('/cpanel/cars/model')->with('message', "Model deleted Successfully");
        }else{
            return redirect('/cpanel/cars/model')->withErrors("Model Not Found");
        }
    }

	public function getAutoTraderThumbImage($url){
		$url = 'http://www.autotrader.com'.$url[0];
		$client = new Client();
		$crawler = $client->request('GET', $url);
		$image =  $crawler->filter('.image-wrapper img')->each(function ($elem){
			return  $elem->attr('src');
		});
		return $image;
	}

	public function postCarDetails(Request $request){
		try{
			$carLink = $request->get('car_link');
			$carData = $request->get('car_data');
			if(!file_exists(public_path() . "/scraper_single")){ mkdir(public_path() . "/scraper_single", 0755, true); };
			$filename = time() . rand() . '.json';
			file_put_contents(public_path() . "/scraper_single/" . $filename, $carData);
			return redirect()->route('get.car.details', ['car_link' => $carLink, 'file' => $filename]);
		}catch(\Exception $e){
			return redirect('/cpanel')->withErrors("Model Not Found");
		}
	}

	public function getCarDetails(){
		try{
			if(Input::has('file') && !empty(Input::get('file'))){
				$file = Input::get('file');
				if(file_exists(public_path() . "/scraper_single/" . $file)){
					$json = json_decode(file_get_contents(public_path() . "/scraper_single/" . $file), true);
					if(isset($json['title']) && isset($json['href']) && isset($json['reference_id']) && isset($json['year']) && isset($json['model']) && isset($json['specs'])){
						$sites = [];
						$carLink = Input::get('car_link');
						/*if(strpos($carLink, 'ebay') !== false){
							$splited = explode('/', $carLink);
							// $newLink = "http://www.ebay.com/itm/" . $splited[4] . "/" . $splited[5];
							$newLink = $carLink;
							$sites = [[
								'url' => $newLink,
								'postWrapper' => '#Body',
								'title' => '.it-ttl',
								'price' => '.vi-price',
								'description' => '#ds_div',
								'imageContainer' => '#icImg',
								'link' => 'a.vip'
							]];
							$json['sourceSite'] = 'Ebay';
						}else if(strpos($carLink, 'vehicle/details') !== false){
							// $newLink = "https://www.carsforsale.com" . $carLink;
							$newLink = $carLink;
							$sites = [[
								'url' => $newLink,
								'postWrapper' => '.page-container',
								'title' => '.vehicle-title',
								'price' => '.VehiclePricing',
								'description' => '#VehicleDesc',
								'imageContainer' => '.active>img',
								'link' => 'a.vip'
							]];
							$json['sourceSite'] = 'Cars For Sale';
						}else if(strpos($carLink, 'classifieds/dealer') !== false){
							// $newLink = "https://www.hemmings.com" . $carLink;
							$newLink = $carLink;
							$sites = [[
								'url' => $newLink,
								'postWrapper' => '#main',
								'title' => '.listing-title',
								'price' => '.listing-price-lg',
								'description' => '#listing-description-details',
								'imageContainer' => '.rsMainSlideImage',
								'link' => 'a.vip'
							]];
							$json['sourceSite'] = 'Hemmings';
						}else if(strpos($carLink, 'classifieds/cars-for-sale') !== false){
							// $newLink = "https://www.hemmings.com" . $carLink;
							$newLink = $carLink;
							$sites = [[
								'url' => $newLink,
								'postWrapper' => '#main',
								'title' => '.listing-title',
								'price' => '.listing-price-lg',
								'description' => '#listing-description-details',
								'imageContainer' => '.rsMainSlideImage',
								'link' => 'a.vip'
							]];
							$json['sourceSite'] = 'Cars For Sale';
						}else if(strpos($carLink, '/cars-for-sale/vehicledetails.xhtml?') !== false){
							// $newLink = "http://www.autotrader.com" . $carLink;
							$newLink = $carLink;
							$sites = [[
								'url' => $newLink,
								'postWrapper' => '.vdpincludetest',
								'title' => '.text-lg span',
								'price' => 'div[data-qaid="cntnr-pricing-cmp-outer"] strong',
								'description' => '#listing-description-details',
								'imageContainer' => '.image-wrapper',
								'link' => 'a.vip'
							]];
							$json['sourceSite'] = 'Autotrader';
						}*/
						$json['sourceSite'] = (strpos($json['href'], strtolower('hemmings'))) ? 'Hemmings' : ((strpos($json['href'], strtolower('ebay'))) ? 'Ebay' : ((strpos($json['href'], strtolower('carsforsale'))) ? 'Carsforsale' : ((strpos($json['href'], strtolower('autotrader'))) ? 'Autotrader' : (strpos($json['href'], strtolower('gatewayclassiccars'))) ? 'Gateway Classic cars' : '' )));
						// $sites['single'] = 1;
						// $cars = $this->crawlCars($sites);
						// $car = "";
						// foreach($cars as $car1){
						// 	$car = $car1;
						// 	break;
						// }
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
						$json['imgUrlsMedium'] = $json['src'];
						$json['image'] = url('/placeholder.jpg');
						$json['engine'] = '';
						$json['transmission'] = "automatic";
						if(count($json['src']) > 0){
							$json['src'] = array_unique($json['src']);
							$json['image'] = $json['src'][0];
						};
						if(isset($json['specs']) && isset($json['specs']['description'])){
							$jsonSpecs = $json['specs'];
							unset($jsonSpecs['description']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior/Exterior'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior/Exterior'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior']);
							$values = explode('/', $jsonSpecs['Interior/Exterior']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior/Exterior']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior/Exterior Color'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior/Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Color']);
							$values = explode('/', $jsonSpecs['Interior/Exterior Color']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior/Exterior Color']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior/Exterior Colors'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior/Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Colors']);
							$values = explode('/', $jsonSpecs['Interior/Exterior Colors']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior/Exterior Color']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior / Exterior'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior / Exterior'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior']);
							$values = explode('/', $jsonSpecs['Interior / Exterior']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior / Exterior']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior / Exterior Color'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior / Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Color']);
							$values = explode('/', $jsonSpecs['Interior / Exterior Color']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior / Exterior Color']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior / Exterior Colors'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior / Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Colors']);
							$values = explode('/', $jsonSpecs['Interior / Exterior Colors']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior / Exterior Colors']);
							$json['specs'] = $jsonSpecs;
						}
						foreach($json['specs'] as $k1 => $v1){
							if(strpos($k1, ":") !== true){ $json[str_replace(':', '', strtolower($k1))] = $v1; }
							else{ $json[strtolower($k1)] = $v1; }
						}
						$json['fullUrl'] = $carLink;
						$json['referenceID'] = $json['reference_id'];
						$pricerules = PriceRule::orderBy('site', 'DESC')->get();
						$pricerule = PriceRule::getPrice($json['price'], $pricerules, $json['href']);
						if(isset($json['description']) && is_array($json['description'])){ $json['description'] = implode($json['description'], ' '); }
						$car = (object) $json;
						return view('admin.carmanager.cardetails', compact('car', 'translate', 'json', 'file', 'pricerule'));
					}
				}
			}
			return redirect('/cpanel')->withError("File Not Found");
		}catch(\Exception $e){
			print_r($e->getMessage());exit;
			return redirect('/cpanel')->withError("File Not Found");
		}
	}

	public function postGatewayclassicCarsDetails(Request $request){
		try{
			$carLink = $request->get('car_link');
			$carData = $request->get('car_data');
			if(!file_exists(public_path() . "/scraper_single")){ mkdir(public_path() . "/scraper_single", 0755, true); };
			$filename = time() . rand() . '.json';
			file_put_contents(public_path() . "/scraper_single/" . $filename, $carData);
			return redirect()->route('get.gatewayclassiccars.details', ['car_link' => $carLink, 'file' => $filename]);
		}catch(\Exception $e){
			return redirect('/cpanel')->withErrors("Model Not Found");
		}
	}

	public function getGatewayclassicCarsDetails(){
		try{
			if(Input::has('file') && !empty(Input::get('file'))){
				$file = Input::get('file');
				if(file_exists(public_path() . "/scraper_single/" . $file)){
					$json = json_decode(file_get_contents(public_path() . "/scraper_single/" . $file), true);
					if(isset($json['title']) && isset($json['href']) && isset($json['reference_id']) && isset($json['year']) && isset($json['model']) && isset($json['specs'])){
						$sites = [];
						$carLink = Input::get('car_link');
						$json['sourceSite'] = 'GatewayClassicCars';
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
						if(empty($json['brand'])){
							$fBrands = ["AMC", "Acura", "Alfa Romeo", "Ariel", "Aston Martin", "Audi", "Austin", "Austin Healey", "BMW", "Bentley", "Bugatti", "Buick", "Cadillac", "Chevrolet", "Chrysler", "Citroën", "Cord", "Daewoo", "Daihatsu", "Datsun", "De Tomaso", "DeLorean", "DeSoto", "Dodge", "Eagle", "Edsel", "Ferrari", "Fiat", "Fisker", "Ford", "GMC", "Geo", "Honda", "Hudson", "Hummer", "Hyundai", "Infiniti", "International Harvester", "Isuzu", "Jaguar", "Jeep", "Kia", "Koenigsegg", "Lamborghini", "Lancia", "Land Rover", "Lexus", "Lincoln", "Lotus", "MG", "Maserati", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "Mini", "Mitsubishi", "Morgan", "Morris", "Nash", "Nissan", "Oldsmobile", "Opel", "Packard", "Peugeot", "Plymouth", "Pontiac", "Porsche", "Ram", "Renault", "Rolls-Royce", "Saab", "Saturn", "Scion", "Shelby", "Skoda", "Smart", "Studebaker", "Subaru", "Sunbeam", "Suzuki", "Tesla", "Toyota", "Triumph", "Volkswagen", "Volvo", "Willys", "Replica/Kit Makes"];
							foreach($fBrands as $key => $fBrand){
								if(strpos($json['model'], $fBrand) !== false){
									$json['brand'] = $fBrand;
									$json['model'] = str_replace($fBrand, '', $json['model']);
								}
							}
						};
						$json['imgUrlsMedium'] = $json['src'];
						$json['image'] = url('/placeholder.jpg');
						$json['engine'] = '';
						$json['transmission'] = "automatic";
						if(count($json['src']) > 0){
							$json['src'] = array_unique($json['src']);
							$json['image'] = $json['src'][0];
						};
						if(isset($json['specs']) && isset($json['specs']['description'])){
							$jsonSpecs = $json['specs'];
							unset($jsonSpecs['description']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior/Exterior'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior/Exterior'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior']);
							$values = explode('/', $jsonSpecs['Interior/Exterior']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior/Exterior']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior/Exterior Color'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior/Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Color']);
							$values = explode('/', $jsonSpecs['Interior/Exterior Color']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior/Exterior Color']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior/Exterior Colors'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior/Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Colors']);
							$values = explode('/', $jsonSpecs['Interior/Exterior Colors']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior/Exterior Color']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior / Exterior'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior / Exterior'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior']);
							$values = explode('/', $jsonSpecs['Interior / Exterior']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior / Exterior']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior / Exterior Color'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior / Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Color']);
							$values = explode('/', $jsonSpecs['Interior / Exterior Color']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior / Exterior Color']);
							$json['specs'] = $jsonSpecs;
						}
						if(isset($json['specs']) && isset($json['specs']['Interior / Exterior Colors'])){
							$jsonSpecs = $json['specs'];
							$jsonSpecs['Interior / Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Colors']);
							$values = explode('/', $jsonSpecs['Interior / Exterior Colors']);
							if(count($values) > 0){
								$jsonSpecs['Interior Color'] = $values[0];
								if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
							}
							unset($jsonSpecs['Interior / Exterior Colors']);
							$json['specs'] = $jsonSpecs;
						}
						foreach($json['specs'] as $k1 => $v1){
							if(strpos($k1, ":") !== true){ $json[str_replace(':', '', strtolower($k1))] = $v1; }
							else{ $json[strtolower($k1)] = $v1; }
						}
						$json['fullUrl'] = $carLink;
						$json['referenceID'] = $json['reference_id'];
						$pricerules = PriceRule::orderBy('site', 'DESC')->get();
						$pricerule = PriceRule::getPrice($json['price'], $pricerules, $json['href']);
						if(isset($json['description']) && is_array($json['description'])){ $json['description'] = implode($json['description'], ' '); }
						$car = (object) $json;
						return view('admin.gatewayclassiccarsdetails', compact('car', 'translate', 'json', 'file', 'pricerule'));
					}
				}
			}
			return redirect('/cpanel')->withError("File Not Found");
		}catch(\Exception $e){
			print_r($e->getMessage());exit;
			return redirect('/cpanel')->withError("File Not Found");
		}
	}

	public function postAddListingAlias(Requests\CarRequest $request){
		$excludeBrands = array('Acura', 'Alpenlite', 'Aluma', 'Alumacraft', 'AM General', 'American Hauler', 'American Motors', 'Amphicar', 'Anderson', 'Aprilia', 'Arctic Cat', 'Baja', 'Bayliner', 'Belmont', 'Big Dog', 'Big Tex', 'Blue Bird', 'Bobcat', 'Bombardier', 'Bravo', 'Bronc', 'Buell', 'Calico', 'Can-Am', 'Cargo Mate', 'Carriage', 'Carry-On', 'Case IH', 'Caterpillar', 'CF Moto', 'Chris-Craft', 'Club Car', 'Coachmen', 'Coleman', 'Continental Cargo', 'Crossroads', 'Cub Cadet', 'Cube Van', 'Cushman', 'Daihatsu', 'Damon', 'Diamo', 'Diamond C', 'Diamond-T', 'Dixie Chopper', 'Doolittle', 'Dutchmen', 'Eagle', 'Eclipse', 'Edsel', 'Featherlite', 'Fisher', 'Fisker', 'Flagstaff', 'Four Winns', 'Freedom', 'Freightliner', 'GEM', 'Genesis', 'GEO', 'Georgie Boy', 'Glastron', 'Great Dane', 'Gulf Stream', 'H&H', 'Haulmark', 'Heartland', 'Hino', 'Holiday Rambler', 'Homesteader', 'Honda', 'Hudson', 'Husqvarna', 'Hyosung', 'Hyundai', 'IHC', 'Indian', 'Infiniti', 'International', 'Interstate', 'Isuzu', 'Itasca', 'Jay Feather', 'Jay Flight', 'Jayco', 'John Deere', 'Jonway', 'Joyner', 'Kaiser', 'Kaufman', 'Kenworth', 'Keystone', 'Kia', 'Kioti', 'Kodiak', 'Komfort', 'KTM', 'Kubota', 'Kymco', 'Lance', /*'Lancia',*/ 'Lark', 'Larson', 'Leer', 'Lexus', 'Linhai', 'Little Guy', 'Livin Lite', 'Load Trail', 'Look Trailers', 'Mack', 'Maxum', 'McLaren', 'Mercruiser', 'Merkur', 'Midsota', 'Mitsubishi', 'Monaco', 'Monterey', /*'Morgan',*/ 'Nash', 'New Holland', 'Newmar', 'Nissan', 'Nomad', /*'Opel',*/ 'Pace', 'Pace American', 'Packard', 'Palomino', 'Panoz', 'Peace Sports', 'Peterbilt', 'Peugeot', 'Phoenix', 'Piaggio', 'Pleasure-Way', 'Polaris', 'Pro-Line', 'Propel', 'Quality Steel', 'RAM', 'Regal', 'Reiser', 'Rice Trailers', 'Ridley', 'Riverside RV', 'Rockwood', 'Roketa', 'Royal Cargo', 'R-Vision', /*'Saab',*/ 'Salem', 'Saturn', 'Scion', 'Sea Ray', 'Sea-Doo', 'Skeeter', 'Ski-Doo', 'Skyline', 'Smart', 'Snapper', 'Starcraft', 'Sterling', 'Subaru', 'Sunbeam', 'Sunny Brook', 'Sure-Trac', 'Suzuki', 'Tesla', 'Thor Industries', 'Tiffin', 'Toro', 'Toyota', 'Tracker', 'Triton', 'US Cargo', 'V-Cross', 'Vespa', 'Victory', /*'Volvo',*/ 'Wabash', 'Weekend Warrior', 'Wellcraft', 'Wells Cargo', 'Wildwood', 'Winnebago', 'Xpress', 'Yamaha', 'Yugo');
		if($request->get('listed')){
			$car = Car::find($request->get('car_id'));
			if($car){
				\App\ImageTable::where('car_id', $request->get('car_id'))->delete();
				$car->delete();
			}
			return redirect('/cpanel')->with('message', 'Listing has been removed!');
		}else{
			if(Input::has('file') && !empty(Input::get('file'))){
				$file = Input::get('file');
				if(file_exists(public_path() . "/scraper_single/" . $file)){
					$car = json_decode(file_get_contents(public_path() . "/scraper_single/" . $file), true);
					if(isset($car['title']) && isset($car['href']) && isset($car['reference_id']) && isset($car['year']) && isset($car['model']) && isset($car['specs'])){
						$engine = Input::get('engine');
						// $transmission = Input::get('transmission');
						if(empty($car['brand'])){
							$fBrands = ["AMC", "Acura", "Alfa Romeo", "Ariel", "Aston Martin", "Audi", "Austin", "Austin Healey", "BMW", "Bentley", "Bugatti", "Buick", "Cadillac", "Chevrolet", "Chrysler", "Citroën", "Cord", "Daewoo", "Daihatsu", "Datsun", "De Tomaso", "DeLorean", "DeSoto", "Dodge", "Eagle", "Edsel", "Ferrari", "Fiat", "Fisker", "Ford", "GMC", "Geo", "Honda", "Hudson", "Hummer", "Hyundai", "Infiniti", "International Harvester", "Isuzu", "Jaguar", "Jeep", "Kia", "Koenigsegg", "Lamborghini", "Lancia", "Land Rover", "Lexus", "Lincoln", "Lotus", "MG", "Maserati", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "Mini", "Mitsubishi", "Morgan", "Morris", "Nash", "Nissan", "Oldsmobile", "Opel", "Packard", "Peugeot", "Plymouth", "Pontiac", "Porsche", "Ram", "Renault", "Rolls-Royce", "Saab", "Saturn", "Scion", "Shelby", "Skoda", "Smart", "Studebaker", "Subaru", "Sunbeam", "Suzuki", "Tesla", "Toyota", "Triumph", "Volkswagen", "Volvo", "Willys", "Replica/Kit Makes"];
							foreach($fBrands as $key => $fBrand){
								if(strpos($car['model'], $fBrand) !== false){
									$car['brand'] = $fBrand;
									$car['model'] = str_replace($fBrand, '', $car['model']);
								}
							}
						};
						$brand = trim($car['brand']);
						$model = trim($car['model']);
						$year = trim($car['year']);
						$title = trim($car['title']);
						$reference_id = $car['reference_id'];
						$make = Make::where('name', $brand)->first();
						if(!$make){ $make = Make::create(["name" => $brand, ]); }
						$makeModel = MakeModel::where('name', $model)->orWhere('value', $model)->first();
						if(!$makeModel && $make){ MakeModel::create(["name" => $model, "value" => $model, "make_id" => $make->id, ]); }
						if(!in_array(strtolower($brand), array_map("strtolower", $excludeBrands))){
							$cars = \App\Car::all();
							$price = trim($car['price']);
							$original_url = trim($car['href']);
							$mileage = trim($car['mileage']);
							$kilometers = trim($car['kilometers']);
							if(isset($car['specs']) && isset($car['specs']['description'])){
								$jsonSpecs = $car['specs'];
								$car['description'] = $jsonSpecs['description'];
								unset($jsonSpecs['description']);
								$car['specs'] = [];
								foreach($jsonSpecs as $k1 => $v1){
									if(strpos($k1, ":") !== true){ $car['specs'][str_replace(':', '', strtolower($k1))] = $v1; }
									else{ $car['specs'][strtolower($k1)] = $v1; }
								}
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior']);
								$values = explode('/', $jsonSpecs['Interior/Exterior']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior Color'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Color']);
								$values = explode('/', $jsonSpecs['Interior/Exterior Color']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior Colors'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Colors']);
								$values = explode('/', $jsonSpecs['Interior/Exterior Colors']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior']);
								$values = explode('/', $jsonSpecs['Interior / Exterior']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior Color'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Color']);
								$values = explode('/', $jsonSpecs['Interior / Exterior Color']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior Colors'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Colors']);
								$values = explode('/', $jsonSpecs['Interior / Exterior Colors']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior Colors']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Exterior Color::'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Exterior Color'] = $car['specs']['Exterior Color::'];
								unset($jsonSpecs['Exterior Color::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Interior Color::'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior Color'] = $car['specs']['Interior Color::'];
								unset($jsonSpecs['Interior Color::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Exterior Color:'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Exterior Color'] = $car['specs']['Exterior Color:'];
								unset($jsonSpecs['Exterior Color:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Interior Color:'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior Color'] = $car['specs']['Interior Color:'];
								unset($jsonSpecs['Interior Color:']);
								$car['specs'] = $jsonSpecs;
							}
							$engine = '';
							if(isset($car['specs']['Engine::'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['Engine::'];
								unset($jsonSpecs['Engine::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['engine::'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['engine::'];
								unset($jsonSpecs['engine::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Engine:'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['Engine:'];
								unset($jsonSpecs['Engine:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['engine:'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['engine:'];
								unset($jsonSpecs['engine:']);
								$car['specs'] = $jsonSpecs;
							}
							$transmission = "automatic";
							if(isset($car['specs']['transmission'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['transmission']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['transmission']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission::'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission::']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission:'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission:']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['TRANSMISSION'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['TRANSMISSION']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['TRANSMISSION']);
								$car['specs'] = $jsonSpecs;
							}
							$specification = serialize($car['specs']);
							$description = serialize($car['description']);
							$exists = $cars->where("referenceID", $reference_id);
							$pricerule = [];
							$pricerule['price'] = NULL;
							$pricerule['price_rule_id'] = NULL;
							if(strpos($original_url, 'ebay') !== false || strpos($original_url, 'carsforsale') !== false || strpos($original_url, 'hemming') !== false || strpos($original_url, 'gatewayclassiccars') !== false){
								$pricerules = PriceRule::orderBy('site', 'DESC')->get();
								$pricerule = PriceRule::getPrice($price, $pricerules, $original_url);
							}
							$seller = '';
							if(isset($car['seller_name'])){ $seller = $car['seller_name']; }
							if($exists->count() == 0){
								$carInserted = Car::create([ 'referenceID' => $reference_id, 'title' => $title, 'brand' => $brand, 'model' => $model, 'body' => '', 'year' => $year, 'mileage' => $mileage, 'seller' => $seller,
									'description' => $description, 'price' => $pricerule['price'], 'price_rule_id' => $pricerule['price_rule_id'], 'original_price' => $price, 'original_url' => $original_url, 'transmission' => $transmission, 'engine' => $engine, 'specification' => $specification,
								]);
								$carImages = [];
								$uploadPath = public_path() . '/uploads';
								if(!file_exists($uploadPath)){ mkdir($uploadPath, 0755, true); };
								if(count($car['src']) > 0){
									$car['src'] = array_unique($car['src']);
									foreach($car['src'] as $index => $url){
										$ch = curl_init($url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
										$image = curl_exec($ch);
										$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
										if($code == 200){
											$url = strtok($url, '?');
											$parse = parse_url($url);
											$host = $parse['host'];
											$imagename= basename($url);
											if($host == "thumbs.ebaystatic.com" || $host == "i.ebayimg.com"){
												$url = $url;
												$urlParts = explode("/", $url);
												$folder = $urlParts[5];
												$folderPath = $uploadPath . '/'. $folder;
												if(!file_exists($folderPath)){ mkdir($folderPath, 0755, true); };
												$img_path = $folderPath . '/' .$imagename;
												$image_url = url('/uploads/' . $folder. '/' . $imagename);
											}else{
												$img_path = $uploadPath . '/' . $imagename;
												$image_url = url('/uploads/' . $imagename);
											}
											$im = file_put_contents($img_path, $image); //Where to save the image on your server
											$carImages[] = [ 'car_id' => $carInserted->id, 'medium' => $image_url, 'big' => $image_url, 'featured' => ($index == 1),];
											// $carImages[] = [ 'car_id' => $carInserted->id, 'medium' => $image_url, 'big' => $image_url, 'featured' => ($index == 0),];
										}
										curl_close($ch);
									}
									if(count($carImages) > 0) unset($carImages[0]);
									\App\ImageTable::insert($carImages);
								}
							}
						}
						return redirect('/cpanel')->with('message', 'Les voitures ont été ajoutées !');
					}
				}
			}
		}
		return redirect('/cpanel')->withErrors("Model Not Found");
	}


    public function postAddListing(Requests\CarRequest $request){
        if($request->get('listed')){
            Car::where('id', $request->get('car_id'))->delete();
            if($request->get('backToView')){
                return redirect()->route('get.view.cars')->with('message', 'Listing has been removed!');
            }
        }else{
            $model = $request->get('model');
            $title = $request->get('title');
            $exTitle = explode(' ', $title);
            $brand = $exTitle[1];
            $year = $request->get('year');
            $car = CarsScraped::whereRaw('model = ? AND year = ? AND brand = ? OR title = ?',[$model, $year, $brand, $title])->first();
            if($car){
                $carCreate = Car::create([
                    'referenceID' => $car->referenceID, 'title' => $car->title,
                    'brand' => $car->brand, 'model' => $car->model,
                    'body' => $car->body, 'year' => $car->year,
                    'mileage' => $car->mileage, 'status' => $car->status,
                    'description' => $car->description, 'price' => $car->price,
                    'original_price' => $car->original_price, 'original_url' => $car->original_url,
                    'expired' => $car->expired, 'transmission' => $car->transmission,
                    'engine' => $car->engine, 'specification' => $car->specification,
                ]);
                $i = 0;
                $mediumImages = $car->CarImg;
                foreach($mediumImages as $carImg){
                    $featured = 0;
                    if($i == 0){ $featured = 1; }
                    ImageTable::create([ 'car_id' => $carCreate->id, 'medium' => $carImg->medium, 'big' => $carImg->big, 'featured' => $featured ]);
                    $i++;
                }
            }
            /*$title = $request->get('title');
            $exTitle = explode(' ', $title);
            $brand = $exTitle[1];
            $year = $exTitle[0];
            $request['brand'] = $brand;
            $request['year'] = $year;
            $car = Car::create($request->except(['listed', 'mediums', 'bigs', 'saveImagesLocaly']));
            $i = 0;
            $mediumImages = $request->get('mediums');
            if(!empty($mediumImages)){
                foreach($mediumImages as $medium){
                    $featured = 0;
                    if($i == 0){ $featured = 1; }
                    ImageTable::create([ 'car_id' => $car->id, 'medium' => $medium, 'big' => $request->get('bigs')[$i], 'featured' => $featured ]);
                    $i++;
                }
            }*/
        }
        return back();
    }

	public function getViewCars() {
		$cars = Car::orderBy('created_at', 'DESC')->get();
		return view('admin.carmanager.all', compact('cars'));
	}

	public function getEditCar($id) {
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
		if(!$car){ return redirect('/cpanel/cars/view-cars')->withErrors("Not Found"); }
		$image = $car->images->filter(function($item){ return ($item->featured == true || $item->featured == 1); });
		if($image->count() <= 0 && $car->images->count() > 0){ $car->images->first()->update(["featured" => true, ]); }
		$makedetails = DB::table('makes')->get();
		$car->cylinders = '';
		$car->bodytype = $car->body;
		$car->exterior_color = '';
		$car->interior_color = '';
		if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')){
			$specification = unserialize($car->specification);
			if($specification && isset($specification['Number of Cylinders'])){ $car->cylinders = intval($specification['Number of Cylinders']); };
			if($specification && isset($specification['Cylinders'])){ $car->cylinders = intval($specification['Cylinders']); }
			// if($specification && empty($car->body) && isset($specification['Body Type'])){ $car->bodytype = $specification['Body Type']; }
			if($specification && isset($specification['Exterior Color'])){
				$car->exterior_color = $specification['Exterior Color'];
				foreach($translate as $key2 => $value2){ if(strtolower($specification['Exterior Color']) === strtolower($key2)){ $car->exterior_color = $value2; break; } }
			}
			if($specification && isset($specification['Interior Color'])){
				$car->interior_color = $specification['Interior Color'];
				foreach($translate as $key2 => $value2){ if(strtolower($specification['Interior Color']) === strtolower($key2)){ $car->interior_color = $value2; break; } }
			}
			if($specification && isset($specification['exterior'])){
				$car->exterior_color = $specification['exterior'];
				foreach($translate as $key2 => $value2){
					if(strtolower($specification['exterior']) === strtolower($key2)){
						$car->exterior_color = $value2;
						unset($specification['exterior']);
						$specification['Couleur extérieure'] = $value2;
						break;
					}
				}
			}
			if($specification && isset($specification['interior'])){
				$car->interior_color = $specification['interior'];
				foreach($translate as $key2 => $value2){
					if(strtolower($specification['interior']) === strtolower($key2)){
						$car->interior_color = $value2;
						unset($specification['interior']);
						$specification['Couleur intérieure'] = $value2;
						break;
					}
				}
			}
			if($specification && isset($specification['Interior/Exterior'])){
				$values = explode('/', $specification['Interior/Exterior']);
				if(count($values) > 0){
					$specification['Couleur intérieure'] = $car->interior_color = $values[0];
					if(isset($values[1])){ $specification['Couleur extérieure'] = $car->exterior_color = $values[1]; }
				}
				unset($specification['Interior/Exterior']);
			}
			if($specification && isset($specification['Interior/Exterior Color'])){
				$values = explode('/', $specification['Interior/Exterior Color']);
				if(count($values) > 0){
					$specification['Couleur intérieure'] = $car->interior_color = $values[0];
					if(isset($values[1])){ $specification['Couleur extérieure'] = $car->exterior_color = $values[1]; }
				}
				unset($specification['Interior/Exterior Color']);
			}
			if($specification && isset($specification['Interior/Exterior Colors'])){
				$values = explode('/', $specification['Interior/Exterior Colors']);
				if(count($values) > 0){
					$specification['Couleur intérieure'] = $car->interior_color = $values[0];
					if(isset($values[1])){ $specification['Couleur extérieure'] = $car->exterior_color = $values[1]; }
				}
				unset($specification['Interior/Exterior Colors']);
			}
			if($specification && isset($specification['Interior / Exterior'])){
				$values = explode('/', $specification['Interior / Exterior']);
				if(count($values) > 0){
					$specification['Couleur intérieure'] = $car->interior_color = $values[0];
					if(isset($values[1])){ $specification['Couleur extérieure'] = $car->exterior_color = $values[1]; }
				}
				unset($specification['Interior / Exterior']);
			}
			if($specification && isset($specification['Interior / Exterior Color'])){
				$values = explode('/', $specification['Interior / Exterior Color']);
				if(count($values) > 0){
					$specification['Couleur intérieure'] = $car->interior_color = $values[0];
					if(isset($values[1])){ $specification['Couleur extérieure'] = $car->exterior_color = $values[1]; }
				}
				unset($specification['Interior / Exterior Color']);
			}
			if($specification && isset($specification['Interior / Exterior Colors'])){
				$values = explode('/', $specification['Interior / Exterior Colors']);
				if(count($values) > 0){
					$specification['Couleur intérieure'] = $car->interior_color = $values[0];
					if(isset($values[1])){ $specification['Couleur extérieure'] = $car->exterior_color = $values[1]; }
				}
				unset($specification['Interior / Exterior Colors']);
			}
			$car->specification = serialize($specification);
			Car::find($id)->update(['specification' => serialize($specification)]);
		}
		return view('admin.carmanager.edit', compact('car', 'makedetails', 'translate'));
	}

	public function postEditCar(Requests\CarRequest $request) {
		$car = Car::find($request->get('car_id'));
		if($car){
			$data = $request->except('car_id');
			if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')){
				$specification = unserialize($car->specification);
				$specification['Number of Cylinders'] = $data['cylinders'];
				$specification['Exterior Color'] = $data['exterior_color'];
				$specification['Interior Color'] = $data['interior_color'];
				/*if(isset($specification['Mileage'])){ $specification['Mileage'] = $data['mileage']; };
				if(isset($specification['Transmission'])){ $specification['Transmission'] = $data['transmission']; };*/
				if(isset($specification['Mileage'])){ unset($specification['Mileage']); };
				if(isset($specification['Transmission'])){ unset($specification['Transmission']); };
			}
			$data['body'] = $data['bodytype'];
			unset($data['cylinders'], $data['bodytype'], $data['exterior_color'], $data['interior_color']);
			$data['specification'] = serialize($specification);
			/*$price = PriceRule::getPrice($request->get('price'));
			$data['price'] = $price['price'];
			$data['price_rule_id'] = $price['price_rule_id'];*/
			$car->update($data);
			$make = Make::where('name', $car->brand)->first();
			$model = MakeModel::where('name', $car->model)->orWhere('value', $car->model)->first();
			if(!$model && $make){ MakeModel::create(["name" => $car->model, "value" => $car->model, "make_id" => $make->id, ]); }
			$image = $car->images->filter(function($item){ return ($item->featured == true || $item->featured == 1); });
			if($image->count() <= 0 && $car->images->count() > 0){ $car->images->first()->update(["featured" => true, ]); }
		}
		return back()->with('message', 'Car has been edited!');
	}

    public function postDeleteListing(Request $request){
        if($request->has('carId')){
            $carId = $request->get('carId');
            $carScrapedImages = CarsScrapImage::where('car_id', $carId)->get();
            if($carScrapedImages){
                foreach($carScrapedImages as $carScrapedImage) {
                    if($carScrapedImage) $carScrapedImage->delete();
                }
            }    
            $images = ImageTable::where('car_id', $carId)->get();
            if($images){
                foreach($images as $image) {
                    if($image) $image->delete();
                }
            }    
            $carSite = CarSite::where('car_id', $carId)->first();
            if($carSite) $carSite->delete();
            $order = Orders::where('car_id', $carId)->first();
            if($order) $order->delete();
            $car = Car::find($carId);
            if($car) $car->delete();
            return redirect('/cpanel/cars/view-cars')->with('message', "Car has been deleted!");
        }else return redirect('/cpanel/cars/view-cars')->with('error', "Introuvable !");   
    }

    public function getDeleteCar($id) {
        $car = Car::find($id);
        if($car){ $car->delete(); }
        return back()->with('message', 'Car has been deleted!');
    }

    public function postUploadImages(Request $request){
        if($request->hasFile('files') && $request->has('car_id')){
            $files = $request->file('files');
            if(count($files) > 0){
                $file = $files[0];
                $destinationPath = public_path() . "/uploads/";
                // $filename = rand(1111, 9999) . ".jpg";
                $image = $file->getClientOriginalName();
                $image_file_name = pathinfo($image, PATHINFO_FILENAME);
                $image_extension = pathinfo($image, PATHINFO_EXTENSION);
                $filename = $image_file_name . '_' . time() . "." . $image_extension;
                $uploadSuccess = $file->move($destinationPath, $filename);
                $img = Image::make(public_path() . "/uploads/" . $filename);
                $img->fit(275);
                $img->save(public_path() . "/uploads/thumb/" . $filename);
                if($uploadSuccess){
                    $image = ImageTable::create([
                        'car_id' => $request->get('car_id'),
                        'big' => asset('uploads/') . "/" .$filename,
                        'medium' => asset('uploads/') . "/thumb/" .$filename
                    ]);
                }
                $data = [ 'id' => $image->id, 'url' => asset('uploads/') . "/" .$filename, ];
                return $data;
            }
        }
        return response()->json([ "error" => "First upload image !", ], 400);
    }

    public function uploadNewImages(Request $request) {
        if($request->hasFile('files')){
            $files               = $request->file('files');
            if(count($files) > 0){
                $file = $files[0];
                $destinationPath    = public_path() . "/uploads/";
                // $filename           = rand(1111,9999) . ".jpg";
                $image = $file->getClientOriginalName();
                $image_file_name = pathinfo($image, PATHINFO_FILENAME);
                $image_extension = pathinfo($image, PATHINFO_EXTENSION);
                $filename = $image_file_name . '_' . time() . "." . $image_extension;
                $uploadSuccess      = $file->move($destinationPath, $filename);
                $img = Image::make(public_path() . "/uploads/" . $filename);
                $img->fit(275);
                $img->save(public_path() . "/uploads/thumb/" . $filename);
                if($uploadSuccess){
                    $image = Images::create([
                        'big' => asset('uploads/') . "/" .$filename,
                        'medium' => asset('uploads/') . "/thumb/" .$filename
                    ]);
                }
                $data = [ 'id' => $image->id, 'url' => asset('uploads/') . "/" .$filename, ];
                return $data;
            }    
        }
        return response()->json([ "error" => "First upload image !", ], 400);    
    }

    public function postSaveCroppedImage() {
        $base64string = Input::get('imageData');
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64string));
        // $imageName = rand(1111,9999) .'.jpeg';
        $imageName = rand(1111, 9999) . '_' . time() . '.jpeg';
        file_put_contents(public_path() . '/uploads/' . $imageName, $data);
        $img = Image::make(public_path() . "/uploads/" . $imageName);
        $img->resize(275, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(public_path() . "/uploads/thumb/" . $imageName);

        $image = ImageTable::find(Input::get('imageID'));
        $image->update([
            'big' => asset('uploads/') . "/" . $imageName,
            'medium' => asset('uploads/') . "/thumb/" . $imageName
        ]);

        return asset('uploads/') . "/" . $imageName;

    }

	public function postExportXML(){
		ini_set('max_execution_time', 0);
		if(Input::get('generate_export') == "UBIFLOW"){
			$ids = Input::get('car_id');
			if($ids){
				$carSite = CarSite::whereIn('car_id', $ids)->where('site', 'UBIFLOW')->get();
				$ubiflowIDs = [];
				foreach($carSite as $ubiflow){ $ubiflowIDs[] = $ubiflow->car_id; }
				$getCars = Car::whereIn('id', $ubiflowIDs)->with('images')->get();
			}else{
				$carSite = CarSite::where('site', 'UBIFLOW')->get();
				$ubiflowIDs = [];
				foreach($carSite as $ubiflow){ $ubiflowIDs[] = $ubiflow->car_id; }
				$getCars = Car::whereIn('id', $ubiflowIDs)->with('images')->get();
			}
			$content = View::make('admin.carmanager.exportXml', compact('getCars'))->render();
			$filename = 'XML-Export-' . uniqid() . '.xml';
			// set up basic connection
			$conn_id = ftp_connect("ftp.ubiflow.net");
			// login with username and password
			$login_result = ftp_login($conn_id, "ag931232", "68zoreko");
			ftp_pasv($conn_id, true);
			File::put(storage_path() . '/' . $filename, $content);
			// unlink(storage_path() . '/ubiflow/ag931232.zip');
			if(!file_exists(storage_path() . '/ubiflow')){ mkdir(storage_path() . '/ubiflow', 0755, true); };
			$zip = new \ZipArchive;
			$zip->open(storage_path() . '/ubiflow/ag931232.zip', \ZipArchive::CREATE|\ZipArchive::OVERWRITE);
			$zip->addFile(storage_path() . '/' . $filename, 'ag931232.xml');
			$zip->close();
			if(ftp_put($conn_id, "ag931232.zip", storage_path() . '/ubiflow/ag931232.zip', FTP_BINARY)){
				// echo "successfully uploaded\n";
			}else{
				// echo "There was a problem while uploading";
			}
			// close the connection
			ftp_close($conn_id);
			//  return Response::download(storage_path().'/'.$filename);
			return redirect()->back()->with('message', 'XMl Sucessfully Posted');
		}else{
			return redirect()->back()->with('message', 'Please choose site to export');
		}
	}

	public static function convertPrice($price){
		$url  = "https://www.google.com/finance/converter?a=$price&from=usd&to=eur";
		ini_set("user_agent","Opera/9.80 (Windows NT 6.1; U; Edition Campaign 21; en-GB) Presto/2.7.62 Version/11.00");
		$data = file_get_contents($url);
		preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
		$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
		return number_format($converted);
	}

	public function postAddAllCars(Request $request){
		$allCars = Input::get('all_car_links');
		return $this->postBulkAddListings($request, $allCars);
	}

	public function postDeleteAllCars(){
		Car::truncate();
		ImageTable::truncate();
		return back()->with('message', 'Cars have been deleted!');
	}

	public function postBulkAction(){
		$carIDs = Input::get('car_id');
		if($carIDs){
			if(Input::get('type') == "delete"){
				foreach($carIDs as $carID){ Car::find($carID)->delete(); }
				return back()->with('message', 'Cars have been deleted!');
			}else if(Input::get('type') == "assign"){
				foreach($carIDs as $carID){ CarSite::create(['car_id' => $carID, 'site' => 'UBIFLOW']); }
				return back()->with('message', 'Cars have been assigned to UBIFLOW!');
			}else if(Input::get('type') == "deassign"){
				foreach($carIDs as $carID){ CarSite::where('car_id', intval($carID))->delete(); }
				return back()->with('message', 'Cars have been deassigned from UBIFLOW!');
			}
		}else{
			return back()->with('message', "You didn't select any cars!");
		}
	}

	public function postBulkAddListings(Request $request, $data = null){
		set_time_limit(0);
		$carInsertedIds = [];
		if(isset($data)){ $carLinks = $data; }
		else{ $carLinks = Input::get('bulk_links'); }
		if(count($carLinks) > 0){
			$excludeBrands = array('Acura', 'Alpenlite', 'Aluma', 'Alumacraft', 'AM General', 'American Hauler', 'American Motors', 'Amphicar', 'Anderson', 'Aprilia', 'Arctic Cat', 'Baja', 'Bayliner', 'Belmont', 'Big Dog', 'Big Tex', 'Blue Bird', 'Bobcat', 'Bombardier', 'Bravo', 'Bronc', 'Buell', 'Calico', 'Can-Am', 'Cargo Mate', 'Carriage', 'Carry-On', 'Case IH', 'Caterpillar', 'CF Moto', 'Chris-Craft', 'Club Car', 'Coachmen', 'Coleman', 'Continental Cargo', 'Crossroads', 'Cub Cadet', 'Cube Van', 'Cushman', 'Daihatsu', 'Damon', 'Diamo', 'Diamond C', 'Diamond-T', 'Dixie Chopper', 'Doolittle', 'Dutchmen', 'Eagle', 'Eclipse', 'Edsel', 'Featherlite', 'Fisher', 'Fisker', 'Flagstaff', 'Four Winns', 'Freedom', 'Freightliner', 'GEM', 'Genesis', 'GEO', 'Georgie Boy', 'Glastron', 'Great Dane', 'Gulf Stream', 'H&H', 'Haulmark', 'Heartland', 'Hino', 'Holiday Rambler', 'Homesteader', 'Honda', 'Hudson', 'Husqvarna', 'Hyosung', 'Hyundai', 'IHC', 'Indian', 'Infiniti', 'International', 'Interstate', 'Isuzu', 'Itasca', 'Jay Feather', 'Jay Flight', 'Jayco', 'John Deere', 'Jonway', 'Joyner', 'Kaiser', 'Kaufman', 'Kenworth', 'Keystone', 'Kia', 'Kioti', 'Kodiak', 'Komfort', 'KTM', 'Kubota', 'Kymco', 'Lance', /*'Lancia',*/ 'Lark', 'Larson', 'Leer', 'Lexus', 'Linhai', 'Little Guy', 'Livin Lite', 'Load Trail', 'Look Trailers', 'Mack', 'Maxum', 'McLaren', 'Mercruiser', 'Merkur', 'Midsota', 'Mitsubishi', 'Monaco', 'Monterey', /*'Morgan',*/ 'Nash', 'New Holland', 'Newmar', 'Nissan', 'Nomad', /*'Opel',*/ 'Pace', 'Pace American', 'Packard', 'Palomino', 'Panoz', 'Peace Sports', 'Peterbilt', 'Peugeot', 'Phoenix', 'Piaggio', 'Pleasure-Way', 'Polaris', 'Pro-Line', 'Propel', 'Quality Steel', 'RAM', 'Regal', 'Reiser', 'Rice Trailers', 'Ridley', 'Riverside RV', 'Rockwood', 'Roketa', 'Royal Cargo', 'R-Vision', /*'Saab',*/ 'Salem', 'Saturn', 'Scion', 'Sea Ray', 'Sea-Doo', 'Skeeter', 'Ski-Doo', 'Skyline', 'Smart', 'Snapper', 'Starcraft', 'Sterling', 'Subaru', 'Sunbeam', 'Sunny Brook', 'Sure-Trac', 'Suzuki', 'Tesla', 'Thor Industries', 'Tiffin', 'Toro', 'Toyota', 'Tracker', 'Triton', 'US Cargo', 'V-Cross', 'Vespa', 'Victory', /*'Volvo',*/ 'Wabash', 'Weekend Warrior', 'Wellcraft', 'Wells Cargo', 'Wildwood', 'Winnebago', 'Xpress', 'Yamaha', 'Yugo');
			$ebayPath = public_path() . "/scraperJson/getdata_ebay_" . Session::getId() . ".json";
			$carsforsalePath = public_path() . "/scraperJson/getdata_carsforsale_" . Session::getId() . ".json";
			$hemmingsPath = public_path() . "/scraperJson/getdata_hemmings_" . Session::getId() . ".json";
			$gatewayclassiccarsPath = public_path() . "/scraperJson/getdata_gatewayclassiccars_" . Session::getId() . ".json";
			if(file_exists($ebayPath) || file_exists($carsforsalePath) || file_exists($hemmingsPath) || file_exists($gatewayclassiccarsPath)){
				$carsforsaleJson = [];
				$ebayJson = [];
				$hemmingsJson = [];
				$gatewayclassiccarsJson = [];
				if(file_exists($ebayPath)){
					$ebayJson = Car::getFileContent($ebayPath);
					if(!is_array($ebayJson)){ $ebayJson = []; }
				}
				if(file_exists($carsforsalePath)){
					$carsforsaleJson = Car::getFileContent($carsforsalePath);
					if(!is_array($carsforsaleJson)){ $carsforsaleJson = []; }
				}
				if(file_exists($hemmingsPath)){
					$hemmingsJson = Car::getFileContent($hemmingsPath);
					if(!is_array($hemmingsJson)){ $hemmingsJson = []; }
				}
				if(file_exists($gatewayclassiccarsPath)){
					$gatewayclassiccarsJson = Car::getFileContent($gatewayclassiccarsPath);
					if(!is_array($gatewayclassiccarsJson)){ $gatewayclassiccarsJson = []; }
				}
				$resultJson = array_merge($carsforsaleJson, $ebayJson, $hemmingsJson, $gatewayclassiccarsJson);
				$cars = \App\Car::all();
				foreach($resultJson as $key => $car){
					if(empty($car['brand'])){
						$fBrands = ["AMC", "Acura", "Alfa Romeo", "Ariel", "Aston Martin", "Audi", "Austin", "Austin Healey", "BMW", "Bentley", "Bugatti", "Buick", "Cadillac", "Chevrolet", "Chrysler", "Citroën", "Cord", "Daewoo", "Daihatsu", "Datsun", "De Tomaso", "DeLorean", "DeSoto", "Dodge", "Eagle", "Edsel", "Ferrari", "Fiat", "Fisker", "Ford", "GMC", "Geo", "Honda", "Hudson", "Hummer", "Hyundai", "Infiniti", "International Harvester", "Isuzu", "Jaguar", "Jeep", "Kia", "Koenigsegg", "Lamborghini", "Lancia", "Land Rover", "Lexus", "Lincoln", "Lotus", "MG", "Maserati", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "Mini", "Mitsubishi", "Morgan", "Morris", "Nash", "Nissan", "Oldsmobile", "Opel", "Packard", "Peugeot", "Plymouth", "Pontiac", "Porsche", "Ram", "Renault", "Rolls-Royce", "Saab", "Saturn", "Scion", "Shelby", "Skoda", "Smart", "Studebaker", "Subaru", "Sunbeam", "Suzuki", "Tesla", "Toyota", "Triumph", "Volkswagen", "Volvo", "Willys", "Replica/Kit Makes"];
						foreach($fBrands as $key => $fBrand){
							if(strpos($car['model'], $fBrand) !== false){
								$car['brand'] = $fBrand;
								$car['model'] = str_replace($fBrand, '', $car['model']);
							}
						}
					};
					$brand = trim($car['brand']);
					$model = trim($car['model']);
					$year = trim($car['year']);
					$title = trim($car['title']);
					$reference_id = $car['reference_id'];
					if(!in_array(strtolower($brand), array_map("strtolower", $excludeBrands))){
						$make = Make::where('name', $brand)->first();
						if(!$make){ $make = Make::create(["name" => $brand, ]); }
						$makeModel = MakeModel::where('name', $model)->orWhere('value', $model)->first();
						if(!$makeModel && $make){ MakeModel::create(["name" => $model, "value" => $model, "make_id" => $make->id, ]); }
						if(in_array($reference_id, $carLinks)){
							$price = trim($car['price']);
							$original_url = trim($car['href']);
							$mileage = trim($car['mileage']);
							$kilometers = trim($car['kilometers']);
							if(isset($car['specs']) && isset($car['specs']['description'])){
								$jsonSpecs = $car['specs'];
								$car['description'] = $jsonSpecs['description'];
								unset($jsonSpecs['description']);
								$car['specs'] = [];
								foreach($jsonSpecs as $k1 => $v1){
									if(strpos($k1, ":") !== true){ $car['specs'][str_replace(':', '', strtolower($k1))] = $v1; }
									else{ $car['specs'][strtolower($k1)] = $v1; }
								}
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior']);
								$values = explode('/', $jsonSpecs['Interior/Exterior']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior Color'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Color']);
								$values = explode('/', $jsonSpecs['Interior/Exterior Color']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior Colors'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Colors']);
								$values = explode('/', $jsonSpecs['Interior/Exterior Colors']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior']);
								$values = explode('/', $jsonSpecs['Interior / Exterior']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior Color'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Color']);
								$values = explode('/', $jsonSpecs['Interior / Exterior Color']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior Colors'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Colors']);
								$values = explode('/', $jsonSpecs['Interior / Exterior Colors']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior Colors']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Exterior Color:'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Exterior Color'] = $car['specs']['Exterior Color:'];
								unset($jsonSpecs['Exterior Color:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Interior Color:'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior Color'] = $car['specs']['Interior Color:'];
								unset($jsonSpecs['Interior Color:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Exterior Color::'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Exterior Color'] = $car['specs']['Exterior Color::'];
								unset($jsonSpecs['Exterior Color::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Interior Color::'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior Color'] = $car['specs']['Interior Color::'];
								unset($jsonSpecs['Interior Color::']);
								$car['specs'] = $jsonSpecs;
							}
							$engine = '';
							if(isset($car['specs']['Engine::'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['Engine::'];
								unset($jsonSpecs['Engine::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['engine::'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['engine::'];
								unset($jsonSpecs['engine::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Engine:'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['Engine::'];
								unset($jsonSpecs['Engine:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['engine:'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['engine:'];
								unset($jsonSpecs['engine:']);
								$car['specs'] = $jsonSpecs;
							}
							$transmission = "automatic";
							if(isset($car['specs']['transmission'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['transmission']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['transmission']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission::'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission::']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission:'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission:']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['TRANSMISSION'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['TRANSMISSION']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['TRANSMISSION']);
								$car['specs'] = $jsonSpecs;
							}
							$specification = serialize($car['specs']);
							$description = serialize($car['description']);
							$seller = '';
							if(isset($car['seller_name'])){ $seller = $car['seller_name']; }
							$exists = $cars->where("referenceID", $reference_id);
							$pricerule = [];
							$pricerule['price'] = NULL;
							$pricerule['price_rule_id'] = NULL;
							if(strpos($original_url, 'ebay') !== false || strpos($original_url, 'carsforsale') !== false || strpos($original_url, 'hemming') !== false || strpos($original_url, 'gatewayclassiccars') !== false){
								$pricerules = PriceRule::orderBy('site', 'DESC')->get();
								$pricerule = PriceRule::getPrice($price, $pricerules, $original_url);
							}    
							if($exists->count() == 0){
								$carInserted = Car::create([ 'referenceID' => $reference_id, 'title' => $title, 'brand' => $brand, 'model' => $model, 'body' => '', 'year' => $year, 'mileage' => $mileage, 'seller' => $seller,
									'description' => $description, 'price' => $pricerule['price'], 'original_price' => $price, 'price_rule_id' => $pricerule['price_rule_id'], 'original_url' => $original_url, 'transmission' => $transmission, 'engine' => $engine, 'specification' => $specification,
								]);
								$carInsertedIds[] = $carInserted->id;
								$carImages = [];
								$uploadPath = public_path() . '/uploads';
								if(!file_exists($uploadPath)){ mkdir($uploadPath, 0755, true); };
								if(count($car['src']) > 0){
									$car['src'] = array_unique($car['src']);
									foreach($car['src'] as $index => $url){
										$ch = curl_init($url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
										$image = curl_exec($ch);
										$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
										if($code == 200){
											$url = strtok($url, '?');
											$parse = parse_url($url);
											$host = $parse['host'];
											$imagename= basename($url);
											if($host == "thumbs.ebaystatic.com" || $host == "i.ebayimg.com"){
												$url = $url;
												$urlParts = explode("/", $url);
												$folder = $urlParts[5];
												$folderPath = $uploadPath . '/'. $folder;
												if(!file_exists($folderPath)){ mkdir($folderPath, 0755, true); };
												$img_path = $folderPath . '/' .$imagename;
												$image_url = url('/uploads/' . $folder. '/' . $imagename);
											}else{
												$img_path = $uploadPath . '/' . $imagename;
												$image_url = url('/uploads/' . $imagename);
											}
											$im = file_put_contents($img_path, $image); //Where to save the image on your server
											$carImages[] = [ 'car_id' => $carInserted->id, 'medium' => $image_url, 'big' => $image_url, 'featured' => ($index == 1),];
											// $carImages[] = [ 'car_id' => $carInserted->id, 'medium' => $image_url, 'big' => $image_url, 'featured' => ($index == 0),];
										}
										curl_close($ch);
									}
									if(count($carImages) > 0) unset($carImages[0]);
									\App\ImageTable::insert($carImages);
								}
							}
						}
					}
				}
			}
			if(count($carInsertedIds) > 0){
				$backUrl = str_replace('&amp;', '&', rawurldecode(redirect()->back()->getTargetUrl()));
				return view('admin.cars', compact('carInsertedIds', 'backUrl'));
			}else{ return back()->with('message', 'Les voitures ont été ajoutées !'); }
                               // return back()->with('message', 'Les voitures ont été ajoutées !');
		}else{
			return back()->with('message', "You didn't select any cars!");
		}
	}

	public function postBulkAddListingsAlias(Request $request){
		set_time_limit(0);
		$carInsertedIds = [];
		$carLinks = Input::get('bulk_links');
		if(count($carLinks) > 0){
			$excludeBrands = array('Acura', 'Alpenlite', 'Aluma', 'Alumacraft', 'AM General', 'American Hauler', 'American Motors', 'Amphicar', 'Anderson', 'Aprilia', 'Arctic Cat', 'Baja', 'Bayliner', 'Belmont', 'Big Dog', 'Big Tex', 'Blue Bird', 'Bobcat', 'Bombardier', 'Bravo', 'Bronc', 'Buell', 'Calico', 'Can-Am', 'Cargo Mate', 'Carriage', 'Carry-On', 'Case IH', 'Caterpillar', 'CF Moto', 'Chris-Craft', 'Club Car', 'Coachmen', 'Coleman', 'Continental Cargo', 'Crossroads', 'Cub Cadet', 'Cube Van', 'Cushman', 'Daihatsu', 'Damon', 'Diamo', 'Diamond C', 'Diamond-T', 'Dixie Chopper', 'Doolittle', 'Dutchmen', 'Eagle', 'Eclipse', 'Edsel', 'Featherlite', 'Fisher', 'Fisker', 'Flagstaff', 'Four Winns', 'Freedom', 'Freightliner', 'GEM', 'Genesis', 'GEO', 'Georgie Boy', 'Glastron', 'Great Dane', 'Gulf Stream', 'H&H', 'Haulmark', 'Heartland', 'Hino', 'Holiday Rambler', 'Homesteader', 'Honda', 'Hudson', 'Husqvarna', 'Hyosung', 'Hyundai', 'IHC', 'Indian', 'Infiniti', 'International', 'Interstate', 'Isuzu', 'Itasca', 'Jay Feather', 'Jay Flight', 'Jayco', 'John Deere', 'Jonway', 'Joyner', 'Kaiser', 'Kaufman', 'Kenworth', 'Keystone', 'Kia', 'Kioti', 'Kodiak', 'Komfort', 'KTM', 'Kubota', 'Kymco', 'Lance', /*'Lancia',*/ 'Lark', 'Larson', 'Leer', 'Lexus', 'Linhai', 'Little Guy', 'Livin Lite', 'Load Trail', 'Look Trailers', 'Mack', 'Maxum', 'McLaren', 'Mercruiser', 'Merkur', 'Midsota', 'Mitsubishi', 'Monaco', 'Monterey', /*'Morgan',*/ 'Nash', 'New Holland', 'Newmar', 'Nissan', 'Nomad', /*'Opel',*/ 'Pace', 'Pace American', 'Packard', 'Palomino', 'Panoz', 'Peace Sports', 'Peterbilt', 'Peugeot', 'Phoenix', 'Piaggio', 'Pleasure-Way', 'Polaris', 'Pro-Line', 'Propel', 'Quality Steel', 'RAM', 'Regal', 'Reiser', 'Rice Trailers', 'Ridley', 'Riverside RV', 'Rockwood', 'Roketa', 'Royal Cargo', 'R-Vision', /*'Saab',*/ 'Salem', 'Saturn', 'Scion', 'Sea Ray', 'Sea-Doo', 'Skeeter', 'Ski-Doo', 'Skyline', 'Smart', 'Snapper', 'Starcraft', 'Sterling', 'Subaru', 'Sunbeam', 'Sunny Brook', 'Sure-Trac', 'Suzuki', 'Tesla', 'Thor Industries', 'Tiffin', 'Toro', 'Toyota', 'Tracker', 'Triton', 'US Cargo', 'V-Cross', 'Vespa', 'Victory', /*'Volvo',*/ 'Wabash', 'Weekend Warrior', 'Wellcraft', 'Wells Cargo', 'Wildwood', 'Winnebago', 'Xpress', 'Yamaha', 'Yugo');
			$ebayPath = public_path() . "/scraperJson/getdata_ebay_" . Session::getId() . ".json";
			$carsforsalePath = public_path() . "/scraperJson/getdata_carsforsale_" . Session::getId() . ".json";
			$hemmingsPath = public_path() . "/scraperJson/getdata_hemmings_" . Session::getId() . ".json";
			$gatewayclassiccarsPath = public_path() . "/scraperJson/getdata_gatewayclassiccars_" . Session::getId() . ".json";
			if(file_exists($ebayPath) || file_exists($carsforsalePath) || file_exists($hemmingsPath) || file_exists($gatewayclassiccarsPath)){
				$carsforsaleJson = [];
				$ebayJson = [];
				$hemmingsJson = [];
				$gatewayclassiccarsJson = [];
				if(file_exists($ebayPath)){
					$ebayJson = Car::getFileContent($ebayPath);
					if(!is_array($ebayJson)){ $ebayJson = []; }
				}
				if(file_exists($carsforsalePath)){
					$carsforsaleJson = Car::getFileContent($carsforsalePath);
					if(!is_array($carsforsaleJson)){ $carsforsaleJson = []; }
				}
				if(file_exists($hemmingsPath)){
					$hemmingsJson = Car::getFileContent($hemmingsPath);
					if(!is_array($hemmingsJson)){ $hemmingsJson = []; }
				}
				if(file_exists($gatewayclassiccarsPath)){
					$gatewayclassiccarsJson = Car::getFileContent($gatewayclassiccarsPath);
					if(!is_array($gatewayclassiccarsJson)){ $gatewayclassiccarsJson = []; }
				}
				$resultJson = array_merge($carsforsaleJson, $ebayJson, $hemmingsJson, $gatewayclassiccarsJson);
				$cars = \App\Car::all();
				foreach($resultJson as $key => $car){
					if(empty($car['brand'])){
						$fBrands = ["AMC", "Acura", "Alfa Romeo", "Ariel", "Aston Martin", "Audi", "Austin", "Austin Healey", "BMW", "Bentley", "Bugatti", "Buick", "Cadillac", "Chevrolet", "Chrysler", "Citroën", "Cord", "Daewoo", "Daihatsu", "Datsun", "De Tomaso", "DeLorean", "DeSoto", "Dodge", "Eagle", "Edsel", "Ferrari", "Fiat", "Fisker", "Ford", "GMC", "Geo", "Honda", "Hudson", "Hummer", "Hyundai", "Infiniti", "International Harvester", "Isuzu", "Jaguar", "Jeep", "Kia", "Koenigsegg", "Lamborghini", "Lancia", "Land Rover", "Lexus", "Lincoln", "Lotus", "MG", "Maserati", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "Mini", "Mitsubishi", "Morgan", "Morris", "Nash", "Nissan", "Oldsmobile", "Opel", "Packard", "Peugeot", "Plymouth", "Pontiac", "Porsche", "Ram", "Renault", "Rolls-Royce", "Saab", "Saturn", "Scion", "Shelby", "Skoda", "Smart", "Studebaker", "Subaru", "Sunbeam", "Suzuki", "Tesla", "Toyota", "Triumph", "Volkswagen", "Volvo", "Willys", "Replica/Kit Makes"];
						foreach($fBrands as $key => $fBrand){
							if(strpos($car['model'], $fBrand) !== false){
								$car['brand'] = $fBrand;
								$car['model'] = str_replace($fBrand, '', $car['model']);
							}
						}
					};
					$brand = trim($car['brand']);
					$model = trim($car['model']);
					$year = trim($car['year']);
					$title = trim($car['title']);
					$reference_id = $car['reference_id'];
					if(!in_array(strtolower($brand), array_map("strtolower", $excludeBrands))){
						$make = Make::where('name', $brand)->first();
						if(!$make){ $make = Make::create(["name" => $brand, ]); }
						$makeModel = MakeModel::where('name', $model)->orWhere('value', $model)->first();
						if(!$makeModel && $make){ MakeModel::create(["name" => $model, "value" => $model, "make_id" => $make->id, ]); }
						if(in_array($reference_id, $carLinks)){
							$price = trim($car['price']);
							$original_url = trim($car['href']);
							$mileage = trim($car['mileage']);
							$kilometers = trim($car['kilometers']);
							if(isset($car['specs']) && isset($car['specs']['description'])){
								$jsonSpecs = $car['specs'];
								$car['description'] = $jsonSpecs['description'];
								unset($jsonSpecs['description']);
								$car['specs'] = [];
								foreach($jsonSpecs as $k1 => $v1){
									if(strpos($k1, ":") !== true){ $car['specs'][str_replace(':', '', strtolower($k1))] = $v1; }
									else{ $car['specs'][strtolower($k1)] = $v1; }
								}
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior']);
								$values = explode('/', $jsonSpecs['Interior/Exterior']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior Color'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Color']);
								$values = explode('/', $jsonSpecs['Interior/Exterior Color']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior/Exterior Colors'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior/Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior/Exterior Colors']);
								$values = explode('/', $jsonSpecs['Interior/Exterior Colors']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior/Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior']);
								$values = explode('/', $jsonSpecs['Interior / Exterior']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior Color'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior Color'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Color']);
								$values = explode('/', $jsonSpecs['Interior / Exterior Color']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior Color']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']) && isset($car['specs']['Interior / Exterior Colors'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior / Exterior Colors'] = str_replace(' ', '', $jsonSpecs['Interior / Exterior Colors']);
								$values = explode('/', $jsonSpecs['Interior / Exterior Colors']);
								if(count($values) > 0){
									$jsonSpecs['Interior Color'] = $values[0];
									if(isset($values[1])){ $jsonSpecs['Exterior Color'] = $values[1]; }
								}
								unset($jsonSpecs['Interior / Exterior Colors']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Exterior Color::'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Exterior Color'] = $car['specs']['Exterior Color::'];
								unset($jsonSpecs['Exterior Color::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Interior Color::'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior Color'] = $car['specs']['Interior Color::'];
								unset($jsonSpecs['Interior Color::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Exterior Color:'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Exterior Color'] = $car['specs']['Exterior Color:'];
								unset($jsonSpecs['Exterior Color:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Interior Color:'])){
								$jsonSpecs = $car['specs'];
								$jsonSpecs['Interior Color'] = $car['specs']['Interior Color:'];
								unset($jsonSpecs['Interior Color:']);
								$car['specs'] = $jsonSpecs;
							}
							$engine = '';
							if(isset($car['specs']['Engine::'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['Engine::'];
								unset($jsonSpecs['Engine::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['engine::'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['engine::'];
								unset($jsonSpecs['engine::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Engine:'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['Engine:'];
								unset($jsonSpecs['Engine:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['engine:'])){
								$jsonSpecs = $car['specs'];
								$engine = $car['specs']['engine:'];
								unset($jsonSpecs['engine:']);
								$car['specs'] = $jsonSpecs;
							}
							$transmission = "automatic";
							if(isset($car['specs']['transmission'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['transmission']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['transmission']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission::'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission::']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission::']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['Transmission:'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['Transmission:']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['Transmission:']);
								$car['specs'] = $jsonSpecs;
							}
							if(isset($car['specs']['TRANSMISSION'])){
								$jsonSpecs = $car['specs'];
								$pos = strpos(strtolower($car['specs']['TRANSMISSION']), 'manual');
								if($pos !== false){ $transmission = 'manual'; }
								unset($jsonSpecs['TRANSMISSION']);
								$car['specs'] = $jsonSpecs;
							}
							$specification = serialize($car['specs']);
							$description = serialize($car['description']);
							$seller = '';
							if(isset($car['seller_name'])){ $seller = $car['seller_name']; }
							$exists = $cars->where("referenceID", $reference_id);
							$pricerule = [];
							$pricerule['price'] = NULL;
							$pricerule['price_rule_id'] = NULL;
							if(strpos($original_url, 'ebay') !== false || strpos($original_url, 'carsforsale') !== false || strpos($original_url, 'hemming') !== false || strpos($original_url, 'gatewayclassiccars') !== false){
								$pricerules = PriceRule::orderBy('site', 'DESC')->get();
								$pricerule = PriceRule::getPrice($price, $pricerules, $original_url);
							}    
							if($exists->count() == 0){
								$carInserted = Car::create([ 'referenceID' => $reference_id, 'title' => $title, 'brand' => $brand, 'model' => $model, 'body' => '', 'year' => $year, 'mileage' => $mileage, 'seller' => $seller,
									'description' => $description, 'price' => $pricerule['price'], 'original_price' => $price, 'price_rule_id' => $pricerule['price_rule_id'], 'original_url' => $original_url, 'transmission' => $transmission, 'engine' => $engine, 'specification' => $specification,
								]);
								$carInsertedIds[] = ['val' => intval($reference_id), 'id' => $carInserted->id];
								$carImages = [];
								$uploadPath = public_path() . '/uploads';
								if(!file_exists($uploadPath)){ mkdir($uploadPath, 0755, true); };
								if(count($car['src']) > 0){
									$car['src'] = array_unique($car['src']);
									foreach($car['src'] as $index => $url){
										$ch = curl_init($url);
										curl_setopt($ch, CURLOPT_HEADER, 0);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
										$image = curl_exec($ch);
										$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
										if($code == 200){
											$url = strtok($url, '?');
											$parse = parse_url($url);
											$host = $parse['host'];
											$imagename= basename($url);
											if($host == "thumbs.ebaystatic.com" || $host == "i.ebayimg.com"){
												$url = $url;
												$urlParts = explode("/", $url);
												$folder = $urlParts[5];
												$folderPath = $uploadPath . '/'. $folder;
												if(!file_exists($folderPath)){ mkdir($folderPath, 0755, true); };
												$img_path = $folderPath . '/' .$imagename;
												$image_url = url('/uploads/' . $folder. '/' . $imagename);
											}else{
												$img_path = $uploadPath . '/' . $imagename;
												$image_url = url('/uploads/' . $imagename);
											}
											$im = file_put_contents($img_path, $image); //Where to save the image on your server
											// $carImages[] = [ 'car_id' => $carInserted->id, 'medium' => $image_url, 'big' => $image_url, 'featured' => ($index == 0),];
											$carImages[] = [ 'car_id' => $carInserted->id, 'medium' => $image_url, 'big' => $image_url, 'featured' => ($index == 1),];
										}
										curl_close($ch);
									}
									if(count($carImages) > 0) unset($carImages[0]);
									\App\ImageTable::insert($carImages);
								}
							}
						}
					}
				}
			}
			return response()->json([ "message" => "Les voitures ont été ajoutées !", 'carInsertedIds' => $carInsertedIds], 200);
		}
		return response()->json([ 'error' => "You didn't select any cars!", ], 400);
	}

    public function postSavePriceMarkup() {

        $car = Car::find(Input::get('car_id'));
        $car->update([
            'price' => Input::get('price')
        ]);

        return 1;
    }

    public function postAddNewListing(Requests\CarRequest $request) {
        $input = $request->except(['image_id', 'featuredData']);
        /*$price = PriceRule::getPrice($request->get('price'));
        $input['price'] = $price['price'];
        $input['price_rule_id'] = $price['price_rule_id'];*/
        $specification = ['Number of Cylinders' => $input['cylinders'], 'Exterior Color' => $input['exterior_color'], 'Interior Color' => $input['interior_color']];
        $input['body'] = $input['bodytype'];
        unset($input['cylinders'], $input['bodytype'], $input['exterior_color'], $input['interior_color']);
        $input['specification'] = serialize($specification);
        $car = Car::create($input);
        if($car){
            $make = Make::where('name', $car->brand)->first();
            $model = MakeModel::where('name', $car->model)->orWhere('value', $car->model)->first();
            if(!$model && $make){ MakeModel::create(["name" => $car->model, "value" => $car->model, "make_id" => $make->id, ]); }
        }
        $ids = json_decode(Input::get('image_id'));
        if($ids){
            $featured = Input::has('featuredData');
            $featuredId = Input::get('featuredData');
            foreach ($ids as $key => $id){
                $image = Images::find($id);
                if($image){
                    $data = [ 'car_id' => $car->id, 'medium' => $image->medium, 'big' => $image->big, ];
                    if($key == 0 && !$featured){ $data['featured'] = 1; };
                    if($featured && intval($featuredId) == intval($image->id)){ $data['featured'] = 1; };
                    $imageTable = ImageTable::create($data);
                    $image->delete();
                }
            }
        } 
        return redirect('/cpanel/cars/add')->with('message', "Car Added Successfully ");
        //return $car->id;
    }

    public function filterCars() {

        $cars = new Car;

        if(Input::get('brand') != "") {
            $cars = $cars->where('brand', 'LIKE', '%'. Input::get('brand') .'%');
        }

        if(Input::get('model') != "") {
            $cars = $cars->where('model', 'LIKE', '%' . Input::get('model') . '%');
        }

        if(Input::get('mileage') != "") {
            $cars = $cars->where('mileage', 'LIKE', '%' . intval(Input::get('mileage')) . '%');
        }

        if(Input::get('source_site') != "") {
            $cars = $cars->where('original_url', 'LIKE', '%' . Input::get('source_site') . '%');
        }

        if(Input::get('year1') != "" && Input::get('year2') != "") {
            $cars = $cars->whereBetween('year', [intval(Input::get('year1')), intval(Input::get('year2'))]);
        }

        if(Input::get('price1') != "" && Input::get('price2') != "") {
            $cars = $cars->whereBetween('price', [intval(Input::get('price1')), intval(Input::get('price2'))]);
        }

        if(Input::get('export_site') != "") {
            $carSite = CarSite::where('site', Input::get('export_site'))->get();

            $ids = [];

            foreach ($carSite as $cs) {
                $ids[] = $cs->car_id;
            }

            $cars = $cars->whereIn('id', $ids);

        }


        $cars = $cars->orderBy('created_at', 'DESC')->get();

        return view('admin.carmanager.all', compact('cars'));

    }

    public function postApplyFeaturedImage(){
        if(!Input::has('featured_image')){
            return back()->with('message', 'Car added');
        }
        if(Input::get('carImage_id')) {
            $image = ImageTable::where('car_id', Input::get('carImage_id'));
            $image->update([ 'featured' => 0, ]);
        }
        $image = ImageTable::find(Input::get('featured_image'));
        $image->featured = 1;
        $image->update();
        if(Input::get('carImage_id')) {
            return back()->with('message2', 'Featured image changed!');
        }
        return back()->with('message', 'Car and its images added');
    }

    public function postDeleteImage(Request $request) {
        ImageTable::find(Input::get('imageId'))->delete();
        if($request->has('carId') && $request->get('carId')){
            $car_id = $request->get('carId');
            $image = ImageTable::whereRaw('car_id = ? AND featured = ?', [$car_id, 1]);
            if($image->count() <= 0 ){
                $setFeature = ImageTable::where('car_id', $car_id)->first();
                if($setFeature->count() > 0){
                    $setFeature->featured = 1;
                    $setFeature->update();
                }
            }
        }
        return 1;
    }

    public function deleteCheckedImage() {
        $ids = Input::get('imageId');
        if($ids){
            $images = ImageTable::whereIn('id', $ids)->get();
            $carId = null;
            if($images->count() > 0){
                $carId = $images->first()->car_id;
                foreach($images as $value){ $value->delete(); }
                $car = Car::find($carId);
                if($car){
                    $image = $car->images->filter(function($item){ return ($item->featured == true || $item->featured == 1); });
                    if($image->count() <= 0 && $car->images->count() > 0){ $car->images->first()->update(["featured" => true, ]); }
                }
            }
        }
        return 1;
    }

    public function getImage($id){
        $car_image = ImageTable::where('id', '=', $id)->first();
        return view("admin.carmanager.uploadedImage", compact('car_image'));
    }

    public function getJewelCars(){
        $cars = Car::where('expired', false)->orderBy('created_at', 'DESC')->get();
        $jewel = Jewel::where('date', date('Y-m-d'))->first();
        return view('admin.jewel.jewelList', compact('cars', 'jewel'));
    }

    public function postJewelCars(){
        if(!Input::has('car_id') || empty(Input::get('car_id'))){
            return redirect('/cpanel/cars/jewel')->withErrors("Please Select Image ");
        }else{
            $now = date('Y-m-d');
            $id = Input::get('car_id');
            $car = Car::find($id);
            if($car){
                $jewel = Jewel::where('date', $now)->first();
                if($jewel){
                    $jewel->update([ 'car_id' => $id, ]);
                    return redirect('/cpanel/cars/jewel')->with('message', "Jewel Image Updated Successfully ");
                }else{
                    Jewel::create([ 'car_id' => $id, 'date' => $now, ]);
                    return redirect('/cpanel/cars/jewel')->with('message', "Jewel Image Inserted Successfully ");
                }
            }else{
                return redirect('/cpanel/cars/jewel')->withErrors("Not Found");
            }
        }
    }

    public function getExpired(){
        $cars = Car::where('expired', false)->get();
        foreach($cars as $car){
            if($car->original_url && !empty($car->original_url)){
                $headers = get_headers($car->original_url);
                $status = substr($headers[0], 9, 3);
                if($status >= 400){
                    $car->update(['expired' => true]);
                }
            }
        }
        return true;
    }

    public function deleteImages($id){
        $images = ImageTable::where('car_id', $id)->get();
        if(count($images) > 0){
            foreach($images as $key => $image){ $image->delete(); };
            return back()->with('message', 'Cars Deleted!');
        }else{ return redirect()->route('get.edit.car', $id)->withErrors("Introuvable"); }
    }

	public function getPricemanager(){
		$checkDefault = PriceRule::where('default_rule', 1)->first();
		if(!$checkDefault){
			PriceRule::create([ 'start_price' => 0, 'end_price' => 0, 'price' => '8000', 'percentage' => '6', 'default_rule' => 1, ]);
		}
		$pricerules = PriceRule::all();
		return view('admin.carmanager.pricemanager', compact('pricerules'));
	}

	public function getAddprice(){
		return view('admin.carmanager.addPricemanager');
	}

	public function postAddprice(Request $request){
		$validator = Validator::make($request->all(), [ 'start_price' => "required|integer", 'end_price' => "required|integer",
			'price' => "required|integer", 'percentage' => "required", 'site' => "required|in:all,ebay,carsforsale,hemmings,gatewayclassiccar",
			'default_rule' => "required|in:0,1",
		]);
		if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
		if($request->end_price < $request->start_price){ return redirect()->back()->with('error', "Prix plancher : Veuillez fournir une valeur inférieure à " . $request->end_price)->withInput(); }
		$pricerules =  PriceRule::orderBy('site', 'DESC')->get();
		$start = $request->start_price;
		$end = $request->end_price;
		if($pricerules->count() > 0){
			/*$conflicts = PriceRule::whereRaw("start_price <= ? AND end_price >= ?", [$end, $start])->get();
			$exactprice = PriceRule::whereRaw("start_price <= ? AND end_price >= ? AND (site = ? OR site = ? OR site = ?)", [$end, $start, 'ebay', 'carsforsale', 'hemmings'])->get();
			$exactAllPrice = PriceRule::whereRaw("start_price <= ? AND end_price >= ? AND site = ?", [$end, $start, 'all'])->get();
			if($conflicts->count() > 0){
				foreach($conflicts as $conflict){
					if(($exactAllPrice->count() > 0 || ($request->site == 'ebay' || $request->site == 'carsforsale' || $request->site == 'hemmings')) || $exactprice->count() > 1 || $request->site == 'all' || $request->site == $conflict->site){
						return redirect()->back()->with('error', 'Les prix plafond et plancher sont invalides')->withInput();
						break;
					}
				}
			}*/
			$conflicts = PriceRule::whereRaw("start_price <= ? AND end_price >= ? AND site = ?", [$end, $start, $request->site])->get();
			$exactAllPrice = PriceRule::whereRaw("start_price <= ? AND end_price >= ? AND site = ?", [$end, $start, 'all'])->get();
			if($exactAllPrice->count() > 0 || $conflicts->count() > 0){
				return redirect()->back()->with('error', 'Les prix plafond et plancher sont invalides')->withInput();
			}
			if($request->site == 'all'){
				$exactprice = PriceRule::whereRaw("start_price <= ? AND end_price >= ? AND (site = ? OR site = ? OR site = ? OR site = ?)", [$end, $start, 'ebay', 'carsforsale', 'hemmings', 'gatewayclassiccar'])->get();
				if($exactprice->count() > 0){
					return redirect()->back()->with('error', 'Les prix plafond et plancher sont invalides')->withInput();
				}
			}
			$site = $request->site;
			if($request->has('default_rule') && $request->get('default_rule') == 1){
				$site = 'all';
				PriceRule::where('default_rule', 1)->update(['default_rule' => 0]);
			}
			$newPriceData = PriceRule::create([ 'start_price' => $start, 'end_price' => $request->end_price,
				'price' => $request->price, 'percentage' => $request->percentage, 'site' => $site, 'default_rule' => $request->default_rule,
			]);
			$cars = Car::whereRaw('original_url != ? ', [''])->get();
			if($cars->count() > 0){
				foreach($cars as $car){
					if(strpos($car->original_url, 'ebay') !== false || strpos($car->original_url, 'carsforsale') !== false || strpos($car->original_url, 'hemmings') !== false || strpos($car->original_url, 'gatewayclassiccar') !== false){
						$data = PriceRule::getPrice($car->original_price, $pricerules, $car->original_url);
						if(isset($data['price'])){ $car->update(['price' => $data['price'], 'price_rule_id' => $data['price_rule_id'] ]); }
					}
				}
			}
			return redirect('/cpanel/price/pricemanager')->with('message',"Créé avec succès!");
		}else{
			PriceRule::create([ 'start_price' => $start, 'end_price' => $end, 'price' => $request->price,
				'percentage' => $request->percentage, 'site' => $request->site, 'default_rule' => $request->default_rule,
			]);
			return redirect('/cpanel/price/pricemanager')->with('message',"Créé avec succès!");
		}
	}

	public function getEditprice(Request $request, $id){
		$pricerule =  PriceRule::find($id);
		if($pricerule) return view('admin.carmanager.editprice', compact('pricerule'));
		else return redirect('/cpanel/price/pricemanager')->withErrors("Introuvable !");
	}

	public function postEditprice(Request $request, $id){
		$validator = Validator::make($request->all(), [ 'start_price' => "required|integer", 'end_price' => "required|integer",
			'price' => "required|integer", 'percentage' => "required", 'site' => "required|in:all,ebay,carsforsale,hemmings,gatewayclassiccar",
			'default_rule' => "required|in:0,1",
		]);
		if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
		if($request->end_price < $request->start_price){ return redirect()->back()->with('error', "Prix plancher : Veuillez fournir une valeur inférieure à " . $request->end_price)->withInput(); }
		$price =  PriceRule::find($id);
		if($price){
			$start = $request->start_price;
			$end = $request->end_price;
			/*$conflicts = PriceRule::whereRaw("id != ? AND start_price <= ? AND end_price >= ?", [$id, $end, $start])->get();
			$exactprice = PriceRule::whereRaw("id != ? AND start_price <= ? AND end_price >= ? AND (site = ? OR site = ? OR site = ?)", [$id, $end, $start, 'ebay', 'carsforsale', 'hemmings'])->get();
			$exactAllPrice = PriceRule::whereRaw("id != ? AND start_price <= ? AND end_price >= ? AND site = ?", [$id, $end, $start, 'all'])->get();
			if($conflicts->count() > 0){
				foreach($conflicts as $conflict){
					if(($exactAllPrice->count() > 0 || ($request->site == 'ebay' || $request->site == 'carsforsale' || $request->site == 'hemmings')) || $exactprice->count() > 1 || $request->site == 'all' || $request->site == $conflict->site){
						return redirect()->back()->with('error', 'Les prix plafond et plancher sont invalides')->withInput();
						break;
					}
				}
			}*/
			$conflicts = PriceRule::whereRaw("id != ? AND start_price <= ? AND end_price >= ? AND site = ?", [$id, $end, $start, $request->site])->get();
			$exactAllPrice = PriceRule::whereRaw("id != ? AND start_price <= ? AND end_price >= ? AND site = ?", [$id, $end, $start, 'all'])->get();
			if($exactAllPrice->count() > 0 || $conflicts->count() > 0){
				return redirect()->back()->with('error', 'Les prix plafond et plancher sont invalides')->withInput();
			}
			if($request->site == 'all'){
				$exactprice = PriceRule::whereRaw("id != ? AND start_price <= ? AND end_price >= ? AND (site = ? OR site = ? OR site = ? OR site = ?)", [$id, $end, $start, 'ebay', 'carsforsale', 'hemmings', 'gatewayclassiccar'])->get();
				if($exactprice->count() > 0){
					return redirect()->back()->with('error', 'Les prix plafond et plancher sont invalides')->withInput();
				}
			}
			$site = $request->site;
			if($request->has('default_rule') && $request->get('default_rule') == 1){
				$site = 'all';
				PriceRule::whereRaw('id != ? AND default_rule = ?', [$id, 1])->update(['default_rule' => 0]);
			}
			$price->update([ 'start_price' => $start, 'end_price' => $end,
				'price' => $request->get('price'), 'percentage' => $request->get('percentage'),
				'price_type' => $request->get('price_type'), 'site' => $site, 'default_rule' => $request->get('default_rule'),
			]);
			$cars = Car::whereRaw('original_url != ? ', [''])->get();
			if($cars->count() > 0){
				$pricerules =  PriceRule::orderBy('site', 'DESC')->get();
				foreach($cars as $car){
					if(strpos($car->original_url, 'ebay') !== false || strpos($car->original_url, 'carsforsale') !== false || strpos($car->original_url, 'hemmings') !== false || strpos($car->original_url, 'gatewayclassiccar') !== false){
						$data = PriceRule::getPrice($car->original_price, $pricerules, $car->original_url);
						if(isset($data['price'])){ $car->update(['price' => $data['price'], 'price_rule_id' => $data['price_rule_id'] ]); }
					}        
				}
			}
			return redirect('/cpanel/price/pricemanager')->with('message',"Mis à jour avec succès!"); 
		}else return redirect('/cpanel/price/pricemanager')->withErrors("Introuvable !");
	}

	public function getDeleteprice(Request $request, $id){
		$pricerule =  PriceRule::find($id);
		if($pricerule->default_rule == 1) return redirect('/cpanel/price/pricemanager')->with('error',"Introuvable !");
		if($pricerule){
			$pricerule->delete();
			$cars = Car::whereRaw('original_url != ? ', [''])->get();
			if($cars->count() > 0){
				$pricerules = PriceRule::orderBy('site', 'DESC')->get();
				foreach($cars as $car){
					if(strpos($car->original_url, 'ebay') !== false || strpos($car->original_url, 'carsforsale') !== false || strpos($car->original_url, 'hemmings') !== false || strpos($car->original_url, 'gatewayclassiccar') !== false){
						$data = PriceRule::getPrice($car->original_price, $pricerules, $car->original_url);
						if(isset($data['price'])){
							$car->update(['price' => $data['price'], 'price_rule_id' => $data['price_rule_id'] ]);
						}
					}
				}
			}
			$checkDefault = PriceRule::where('default_rule', 1)->first();
			if(!$checkDefault){
				PriceRule::create([ 'start_price' => 0, 'end_price' => 0, 'price' => '8000', 'percentage' => '6', 'default_rule' => 1, ]);
			}
			return redirect('/cpanel/price/pricemanager')->with('message',"supprimé avec succès");
		}else return redirect('/cpanel/price/pricemanager')->with('error', "Introuvable !");    
	}

	public function getDefaultrule(){
		$pricerules = PriceRule::whereRaw('default_rule = ?', [1])->get();
		if($pricerules->count() > 0) $data = 'exists';
		else $data = 'notexists';
		return $data;
	}

    public function changeEditCar($id, $key){
        $car =  Car::find($id);
        if($car){
            if($key == 'seller'){ $car->update(['seller' => NULL]); }
            else{
                $data = unserialize($car->specification);
                unset($data[$key]);
                $newdata = serialize($data);
                $car->update(['specification' => $newdata]);
            }
            return back()->with('message2', 'Car ' . $key . ' has been deleted!');
        }else return redirect('/cpanel/cars/view-cars')->with('error', "Introuvable !");
    }

}
