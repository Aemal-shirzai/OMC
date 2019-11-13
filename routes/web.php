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

use App\Doctor;
Route::get('/', function () {
    return view('main');
})->name('main');


Route::get("/app",function(){
	return view("layouts.MainLayout");
});

// Routes for Auth
Auth::routes();
// Route to show the page for user to add extra information after the registration process
Route::get("/register/{user}/moreinfo","Auth\RegisterController@moreInfoIndex")->name("moreInfo.index");
// Route to add the more info of user after registration
Route::post("/register/moreinfo/store","Auth\RegisterController@moreInfoStore")->name("moreinfo.store");

Route::get('/profile/{user}', 'ProfileController@index')->name('profile');

// Routes for contuct us
Route::resource('/contactUs','ContactUsController');

// Routes for Post
Route::resource("/post","PostController");

// Routes for comments
Route::resource("/comment","CommentController");

// Routes for CommentReplies
Route::resource("/reply","CommentReplyController");
