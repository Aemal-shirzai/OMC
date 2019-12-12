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
Route::get('/profile/{profile}/edit', 'ProfileController@edit')->name('profile.edit');
// update profile  (doctors and normal users)
Route::MATCH(["PUT","PATCH"],"profile/{profile}/update","ProfileController@updateProfile")->name("profile.update");
// update  account (account table witout passowrd)
Route::MATCH(["PUT","PATCH"],"profile/{profile}/update/account","ProfileController@updateAccount")->name("profile.update.account");
// Delete account
Route::DELETE("/account/destroy","ProfileController@deleteAccount")->name("deleteAccount");
// Change your password
Route::MATCH(['PUT','PATCH'],"/account/changepassword","ProfileController@changePassword")->name("changepassword");

// called using ajax function to upload photo
Route::POST('/profile/photo/', 'ProfileController@uploadPhoto')->name('profile.uploadPhoto');
// called using ajax function to remove photo
Route::DELETE('/profile/photo/remove', 'ProfileController@removePhoto')->name('profile.removePhoto');

// Routes for contuct us
Route::resource('/contactUs','ContactUsController');

// Routes for Post
Route::resource("/posts","PostController");
// This route is responsible for adding and updateing votes to post using ajax request
Route::POST("/posts/vote","PostController@vote")->name("postVote");
// This route is resposible for adding post to favorites by normal user
Route::POST("/posts/favorites","PostController@favorite")->name("postFavorites");
// This route is responsible for deleting post using ajax request
Route::DELETE("/post/delete","PostController@delete")->name("deletePost");
// sort posts route
Route::get("/{type}/posts","PostController@sortBy")->name("postsSortBy");

// Routes for comments
Route::resource("/comments","CommentController");
// route to add comments for questions
Route::POST("/comment/storequestion","CommentController@storeQuestion")->name("storeQuestion");
// This route is responsible for adding and updateing votes to comments using ajax request
Route::POST("/comments/vote","CommentController@vote")->name("commentVote");
// Deleting comment using ajax
Route::DELETE("/comment/delete","CommentController@delete")->name("deleteComment");

// Routes for questions
Route::resource("/questions","QuestionController");
// This route is responsible for adding and updateing votes to question using ajax request
Route::POST("/question/vote","QuestionController@vote")->name("questionVote");
// This route is resposible for adding question to favorites by normal user
Route::POST("/question/favorites","QuestionController@favorite")->name("questionFavorites");
// This route is responsible for deleting question using ajax request
Route::DELETE("/question/delete","QuestionController@delete")->name("deleteQuestion");
// sort questions route
Route::get("/{type}/questions","QuestionController@sortBy")->name("questionsSortBy");


// Routes for CommentReplies
Route::resource("/replies","CommentReplyController");
// This route is responsible for adding and updateing votes to replies using ajax request
Route::POST("/replies/vote","CommentReplyController@vote")->name("replyVote");
// Deleting replies using ajax
Route::DELETE("/reply/delete","CommentReplyController@delete")->name("deleteReply");

// this route is responsible to read the notifications as read using ajax
Route::POST("/markasread","notificationController@readMark")->name("readMark");


route::get("/doctors/search","DoctorController@search")->name("search");
// routes for doctors
Route::resource("/doctors","DoctorController");
// sort posts route
Route::get("/{type}/doctors","DoctorController@sortBy")->name("doctorsSortBy");
//  to aadd acheivements to doctor
Route::Post("/ach/create","DoctorController@achAdd")->name("achAdd");
//  to aadd acheivements to doctor
Route::Post("/ach/image","DoctorController@loadAchImage")->name("loadAchImage");
//  to deete acheivements to doctor
Route::DELETE("/ach/delete","DoctorController@achDelete")->name("achDelete");
//  to return edit page acheivements to doctor
Route::get("/ach/{ach}/edit","DoctorController@achEdit")->name("achEdit");
//  to updte acheivements to doctor
Route::MATCH(['PUT','PATCH'],"/ach/{ach}/update","DoctorController@achUpdate")->name("achUpdate");

// Routes for normal users
Route::resource("/nusers","NormalUserController");
// sort posts route
Route::get("/{type}/nusers","NormalUserController@sortBy")->name("nusersSortBy");
// Route for managing normal user following the doctor
Route::post("/follow/doctors","NormalUserController@DoctorFollow")->name("DoctorFollow");
// Route for removing followers by doctors
Route::post("/remove/follower/","NormalUserController@removeFollower")->name("removeFollower");

