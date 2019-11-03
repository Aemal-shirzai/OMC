<?php

namespace App\Providers;
use App\Country;
use App\Province;
use App\District;
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
        // $c = Country::all();
        // if(count($c)>0){
        //     $countries = Country::pluck("country","id");
        //     $provinces1 = Country::find(1)->provinces()->pluck("province","id");
        //     $provinces2 = Country::find(2)->provinces()->pluck("province","id");
        //     $provinces3 = Country::find(3)->provinces()->pluck("province","id");
        //     $provinces4 = Country::find(4)->provinces()->pluck("province","id");

        //     $districts1 = Province::find(1)->districts()->pluck("district","id");
        //     $districts2 = Province::find(2)->districts()->pluck("district","id");
        //     $districts3 = Province::find(3)->districts()->pluck("district","id");
        //     $districts4 = Province::find(4)->districts()->pluck("district","id");
        //     $districts5 = Province::find(5)->districts()->pluck("district","id");
        //     $districts6 = Province::find(6)->districts()->pluck("district","id");
        //     $districts7 = Province::find(7)->districts()->pluck("district","id");
        //     $districts8 = Province::find(8)->districts()->pluck("district","id");
        //     $districts9 = Province::find(9)->districts()->pluck("district","id");
        //     $districts10 = Province::find(10)->districts()->pluck("district","id");
        //     View::share([
        //         "countries"=>$countries,
        //         "provinces1"=>$provinces1,"provinces2"=>$provinces2,"provinces3"=>$provinces3,"provinces4"=>$provinces4,
        //         "districts1"=>$districts1,"districts2"=>$districts2,"districts3"=>$districts3,"districts4"=>$districts4,"districts5"=>$districts5,"districts6"=>$districts6,"districts7"=>$districts7,"districts8"=>$districts8,"districts9"=>$districts9,"districts10"=>$districts10]);
        // }

        // $countries = Country::pluck("country","id");
        // View::share(["countries"=>$countries]);

        Schema::defaultStringLength(190);
    }
}
