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
Route::resource("/posts","PostController");
// This route is responsible for adding and updateing votes to post using ajax request
Route::POST("/posts/vote","PostController@vote")->name("postVote");
// This route is resposible for adding post to favorites by normal user
Route::POST("/posts/favorites","PostController@favorite")->name("postFavorites");


// Routes for comments
Route::resource("/comments","CommentController");
// This route is responsible for adding and updateing votes to comments using ajax request
Route::POST("/comments/vote","CommentController@vote")->name("commentVote");
// Deleting comment using ajax
Route::DELETE("/comments/delete","CommentController@delete")->name("deleteComment");


// Routes for CommentReplies
Route::resource("/replies","CommentReplyController");
// This route is responsible for adding and updateing votes to replies using ajax request
Route::POST("/replies/vote","CommentReplyController@vote")->name("replyVote");
// Deleting replies using ajax
Route::DELETE("/replies/delete","CommentReplyController@delete")->name("deleteReply");


// Route for managing normal user following the doctor
Route::post("/follow/doctors","NormalUserController@DoctorFollow")->name("DoctorFollow");
// Route for removing followers by doctors
Route::post("/remove/follower/","NormalUserController@removeFollower")->name("removeFollower");