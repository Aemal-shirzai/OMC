<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $countries = ["Afghanistan"=>"Afghanistan","Pakistan"=>"Pakistan","India"=>"India","Australia"=>"Australia"];
        $AfghanistanProvinces = ["Kabul"=>"Kabul","Logar"=>"Logar","Wardak"=>"Wardak"];
        // $AfghanistanProvinces = ["Kabul","Logar","Wardak"];
        $PakistanProvinces = ["Lahor"=>"Lahor","Panjab"=>"panjab","Swat"=>"swat"];
        $IndiaProvinces = ["Mombai"=>"Mombai","Kolkata"=>"Kolkata","Hydrabad"=>"Hydrabad"];
        $AustraliaProvinces = ["Sydny"=>"Sydny","Samoual"=>"samoual","Boosting"=>"boosting"];

        $KabulDistrict = ["Paghman","shakardara","sorobi","nawabad"];
        $WardakDistrict = ["Jaghato","Chak","Said Abad","Behsod"];
        $LogarDistrict = ["murtaza","hafiz","salim"];

        $LahorDistrict = ["lahor1","lahor2","lahor3"];
        $PanjabDistrict = ["panjab1","panjab2"];
        $SwatDistrict = ["swat1","swat2","swat3","swat4"];

        $MombaiDistrict = ["momb1"];
        $KolkataDistrict =["Kolkata1","Kolkata2"];
        $HydrabadDistrict = ["Rashid Khan", "shaki Hassan","devid Warner"];

        $SydnyDistrict = ["sixers","finch","watson"];
        $SamoualDistrict = ["s1","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2","s2"];
        $BoostingDistrict = ["b1"];

        View::share(["AfghanistanProvinces"=>$AfghanistanProvinces,"PakistanProvinces"=>$PakistanProvinces,"countries"=>$countries,"IndiaProvinces"=>$IndiaProvinces,"AustraliaProvinces"=>$AustraliaProvinces,"KabulDistrict"=>$KabulDistrict,"WardakDistrict"=>$WardakDistrict,"LogarDistrict"=>$LogarDistrict,"LahorDistrict"=>$LahorDistrict,"PanjabDistrict"=>$PanjabDistrict,"SwatDistrict"=>$SwatDistrict,"MombaiDistrict"=>$MombaiDistrict,"KolkataDistrict"=>$KolkataDistrict,"HydrabadDistrict"=>$HydrabadDistrict,"SydnyDistrict"=>$SydnyDistrict,"SamoualDistrict"=>$SamoualDistrict,"BoostingDistrict"=>$BoostingDistrict]);
        Schema::defaultStringLength(190);
    }
}
