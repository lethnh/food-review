<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('auth/user', function (Request $request) {
    return $request->user();
});


/**
 * Auth Route
 */
Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/register', 'Auth\RegisterController@store');
Route::post('auth/forgotpassword', 'Auth\LoginController@login');


Route::group([
    'middleware' => 'auth:api'
], function () {

    Route::post('auth/logout', 'Auth\LogoutController@logOut');
    Route::get('auth/user', 'HomeController@user');


    // Post Review
    Route::get('post-review', 'FrontEnd\PostReviewController@getPostReview');
    Route::get('post-review/{id}', 'FrontEnd\PostReviewController@getPostReviewById');
    Route::post('post-review', 'FrontEnd\PostReviewController@storePostReview');
    Route::delete('post-review/{id}', 'FrontEnd\PostReviewController@storePostReview');

    //Comment
    Route::get('comment', 'FrontEnd\PostReviewController@storePostReview');
});
