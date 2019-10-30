<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\ContactUs;

Route::get('/', function () {
	$data = ContactUs::find(48);
    return view('main',compact("data"));
})->name('main');


Route::get("/app",function(){
	return view("layouts.MainLayout");
});
Auth::routes();

Route::get('/profile/{user}', 'ProfileController@index')->name('profile');
Route::resource('/contactUs','ContactUsController');