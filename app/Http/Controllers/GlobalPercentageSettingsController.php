<?php

namespace App\Http\Controllers;

use App\GlobalPriceSetting;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class GlobalPercentageSettingsController extends Controller
{
    public function postEditPercentage() {
        $gs = GlobalPriceSetting::find(Input::get('id'));
        $gs->update(Input::all());
        return 1;
    }

    public function postAddPercentage() {
        GlobalPriceSetting::create(Input::all());
        return 1;
    }

    public function postGlobalPercentage() {

        if(Input::get('enabled')) {
            Setting::where('enabled', 1)->update(['enabled' => 0, 'percentage' => 0, 'fixed_rate' => 0]);
        }

        $data = [
            'price'         => Input::get('price'),
            'percentage'    => Input::get('percentage'),
        ];

        if(Input::get('enabled')) {
            $data['enabled'] = 1;
        } else {
            $data['enabled'] = 0;
        }

        Setting::find(2)->update($data);
        return 1;
    }

    public function postGlobalRate() {

        if(Input::get('enabled')) {
            Setting::where('enabled', 1)->update(['enabled' => 0, 'percentage' => 0, 'fixed_rate' => 0]);
        }

        $gs = Setting::find(3);

        $data = [
            'fixed_rate'    => Input::get('fixed_rate')
        ];

        if(Input::get('enabled')) {
            $data['enabled'] = 1;
        } else {
            $data['enabled'] = 0;
        }


        $gs->update($data);
        return 1;
    }

    public function postRangePercentage() {

        if(Input::get('enabled')) {
            Setting::where('enabled', 1)->update(['enabled' => 0, 'percentage' => 0, 'fixed_rate' => 0]);
        }

        $data = [];

        if(Input::get('enabled')) {
            $data['enabled'] = 1;
        } else {
            $data['enabled'] = 0;
        }

        Setting::find(1)->update($data);
        return 1;
    }

    public function getDeletePriceRange($id) {
        GlobalPriceSetting::find($id)->delete();
        return 1;
    }

    public static function getRangePercentageSingle($finalPrice) {

        $finalPrice = intval($finalPrice);

        $percentage = 0;


        $getGlobalPriceSettings = \DB::table('global_price_settings')->orderBy('price','asc')->get();

        $getGlobalPriceSettingsCount = count($getGlobalPriceSettings);

        $i=0;


        for ($i; $i<$getGlobalPriceSettingsCount;$i++) {

            if($finalPrice > $getGlobalPriceSettings[$i]->price) {
                if(isset($getGlobalPriceSettings[$i+1])) {
                    if($finalPrice < $getGlobalPriceSettings[$i+1]->price) {
                        $percentage = $getGlobalPriceSettings[$i]->percentage;
                        break;
                    } else {
                        continue;
                    }
                } else {
                    $percentage = $getGlobalPriceSettings[$getGlobalPriceSettingsCount - 1]->percentage;
                    break;
                }
            } else {
                $percentage = 0;
                break;
            }

            /*var_dump($i);

            if ( isset($getGlobalPriceSettings[$i+1]) ) {

                var_dump('da');

                if ( $getGlobalPriceSettings[$i]->price < $finalPrice and $getGlobalPriceSettings[$i+1]->price > $finalPrice) {

                    var_dump('aa');

                    $percentage = $getGlobalPriceSettings[$i]->percentage;

                    dd($percentage);
                    $percentageSet = 1;
                    break;
                }
            }

            else {

                if ( $getGlobalPriceSettings[$i]->price > $finalPrice and $percentageSet != 1)  {

                    var_dump('nada');

                    $percentage = $getGlobalPriceSettings[$i]->percentage;
                    break;

                }
            }*/
        }

        return $percentage;
    }
}
