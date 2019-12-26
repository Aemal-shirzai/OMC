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
use App\Advertisement;
Route::get('/', function () {
	$advertisements = Advertisement::latest()->get();
    return view('main',compact("advertisements"));
})->name('main');


Route::get("/app",function(){
	return view("layouts.MainLayout");
});


// Admin Layouts

// all doctor fields (dcategories) and form to insert the categories from 
Route::get("/admin/dcategories","Admin\DcategoryController@dcategories")->name("dcategories.manage");
// all doctor fields (dcategories) and form to insert the categories from 
Route::DELETE("/admin/dcategories/delete","Admin\DcategoryController@deleteCategories")->name("dcategories.delete");
// route to add the dcateogry for doctors
Route::POST("/admin/dcategories/store","Admin\DcategoryController@storeCategories")->name("dcategories.store");
// Route to retive the data for dcatrogry that needs to be updated
Route::get("/admin/dcategories/edit","Admin\DcategoryController@edit")->name("dcategories.edit");
// to update the doctor categoires
Route::PUT("/admin/dcategories/update","Admin\DcategoryController@update")->name("dcategories.update");

// all tags and form to insert the tags from
Route::get("/admin/tags","Admin\TagController@tags")->name("tags.manage"); 
// delete tags 
Route::DELETE("/admin/tags/delete","Admin\TagController@deleteTags")->name("tags.delete");
// route to add the tags 
Route::POST("/admin/tags/store","Admin\TagController@storeTags")->name("tags.store");
// Route to retive the data for tags that needs to be updated
Route::get("/admin/tags/edit","Admin\TagController@edit")->name("tags.edit");
// to update the doctor categoires
Route::PUT("/admin/tags/update","Admin\TagController@update")->name("tags.update");

// all roles and form to insert the roles from
Route::get("/admin/roles","Admin\RoleController@roles")->name("roles.manage"); 
// delete roles 
Route::DELETE("/admin/roles/delete","Admin\RoleController@deleteRoles")->name("roles.delete");
// route to add the roles 
Route::POST("/admin/roles/store","Admin\RoleController@storeRoles")->name("roles.store");
// Route to retive the data for roles that needs to be updated
Route::get("/admin/roles/edit","Admin\RoleController@edit")->name("roles.edit");
// to update the doctor categoires
Route::PUT("/admin/roles/update","Admin\RoleController@update")->name("roles.update");

// contact us manage part
// route to return the pages of all contact us messages
Route::get("/admin/messages","Admin\ContactController@index")->name("contact.manage");
// route to delte the messages for admin
Route::DELETE("/admin/messages/delete","Admin\ContactController@delete")->name("contact.delete");

// Route for admin achievements
// route to access the admin ads list page, adding form and adding ads category form and list
Route::get("/admin/advertisements","Admin\AdvertisementController@index")->name("ads.index");
// route to add the ads category 
Route::POST("/admin/advertisements/category/store","Admin\AdvertisementController@storeAdsCat")->name("ads.category.store");
// Route to retive the data for ads category that needs to be updated
Route::get("/admin/advertisements/category/edit","Admin\AdvertisementController@editAdsCat")->name("ads.category.edit");
// to update the doctor categoires
Route::PUT("/admin/advertisements/category/update","Admin\AdvertisementController@updateAdsCat")->name("ads.category.update");
// route to delte the ads category for admin
Route::DELETE("/admin/advertisements/category/delete","Admin\AdvertisementController@deleteAdsCat")->name("ads.category.delete");
// To add advertisements 
Route::POST("/admin/advertisements/store","Admin\AdvertisementController@store")->name("ads.store");
// read ads readmore data using ajax
Route::get("/admin/advertisements/readmore","Admin\AdvertisementController@readMore")->name("ads.readMore");
// route to delte the ads for admin
Route::DELETE("/admin/advertisements/delete","Admin\AdvertisementController@deleteAds")->name("ads.delete");
// load ads  data using ajax
Route::get("/admin/advertisements/edit","Admin\AdvertisementController@edit")->name("ads.edit");
// update the advertiseemnts data
Route::PUT("/admin/advertisements/update","Admin\AdvertisementController@update")->name("ads.update");

// Manage users
Route::get("/admin/doctors/manage","Admin\ManageUserController@doctors")->name("doctors.manage.index");
// Search doctors admin
Route::get("/admin/doctors/search","Admin\ManageUserController@search")->name("admin.search.doctors");
// return the search result using ajax in
Route::get("/admin/doctors/search/result","Admin\ManageUserController@searchResult")->name("admin.searchResult.doctors");
// route to activate and dectivate user
Route::PUT("/admin/doctors/changestatus","Admin\ManageUserController@changeStatus")->name("admin.changestatus.doctors");

// normal users part manage
Route::get("/admin/nusers/manage","Admin\ManageUserController@nusers")->name("nusers.manage.index");
// return the search result using ajax
Route::get("admin/nusers/search/result","Admin\ManageUserController@nusersearchResult")->name("admin.searchResult.nusers");
// Search nusers 
Route::get("admin/nusers/search","Admin\ManageUserController@nuserSearch")->name("admin.search.nusers");
// route to activate and dectivate user
Route::PUT("/admin/nusers/changestatus","Admin\ManageUserController@changeStatus")->name("admin.changestatus.nusers");

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
Route::POST('/contactUs/store','ContactUsController@store')->name("contuctus.store");


//Search posts route
Route::get("/posts/search/results","PostController@searchResult")->name("searchResults.posts");
// Search posts 
Route::get("/posts/search","PostController@search")->name("search.posts");
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


//Search questions route ajax
Route::get("/questions/search/results","QuestionController@searchResult")->name("searchResults.questions");
// Search questions 
Route::get("/questions/search","QuestionController@search")->name("search.questions");

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



// route which remove doctor fields
Route::DELETE('/doctors/fields/remove',"DoctorController@removeFields")->name("fields.remove");
// Search doctors 
Route::get("/doctors/search","DoctorController@search")->name("search.doctors");
// return the search result using ajax
Route::get("/doctors/search/result","DoctorController@searchResult")->name("searchResult.doctors");
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

// return the search result using ajax
Route::get("/nusers/search/result","NormalUserController@searchResult")->name("searchResult.nusers");
// Search nusers 
Route::get("/nusers/search","NormalUserController@search")->name("search.nusers");
// Routes for normal users
Route::resource("/nusers","NormalUserController");
// sort posts route
Route::get("/{type}/nusers","NormalUserController@sortBy")->name("nusersSortBy");
// Route for managing normal user following the doctor
Route::post("/follow/doctors","NormalUserController@DoctorFollow")->name("DoctorFollow");
// Route for removing followers by doctors
Route::post("/remove/follower/","NormalUserController@removeFollower")->name("removeFollower");

