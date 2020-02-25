<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Car;
use DB;
use App\CarSite;
use App\GlobalPriceSetting;
use App\ImageTable;
use Goutte\Client;
use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Symfony\Component\DomCrawler\Crawler;

class RemoveDeletedCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemoveDeletedCars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for deleted cars on sites and remove them';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $allCars =  DB::select( DB::raw("SELECT * FROM cars") );
        $client = new Client();
        ini_set('max_execution_time', 0);
        $deleteIds = [];

        foreach ($allCars as $car) {

             $crawler = $client->request('GET', $car->original_url);

            //EBAY

            if (strpos($car->original_url, 'ebay') !== false) {

               $msg_yellow = $crawler->filter('#w1-3-_msg')->each(function ($elem) {

                   return $elem->html();

               });

               if ( isset($msg_yellow[0]) ) {

                  if (strpos($msg_yellow[0], 'ended') !== false) {

                      $deleteIds[] = $car->referenceID;
                  }

              }
          }

           //CARS FOR SALE

             if (strpos($car->original_url, 'carsforsale') !== false) {

                  $error = $crawler->filter('.error-content')->each(function ($elem) {

                   return $elem->html();

                  });

                  if ( !empty($error) ) {

                     $deleteIds[] = $car->referenceID;

                  }

             }

        }

      

         DB::table('cars')->whereIn('referenceID', $deleteIds)->delete(); 
         echo 'cron good';

    }
}
