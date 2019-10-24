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
    Route::get('auth/user', 'Auth\GetUserController@getUser');
    Route::get('auth/post-review', 'Auth\GetUserController@getPostReview');
    Route::post('auth/avatar', 'FrontEnd\Profile\ProfileController@uploadAvatar');
    Route::post('auth/edit', 'FrontEnd\Profile\ProfileController@editUser');

    // Post Review
    Route::get('post-review', 'FrontEnd\PostReview\CreatePostReviewController@getListPostReview');
    Route::post('post-review', 'FrontEnd\PostReview\CreatePostReviewController@storePostReview');
    Route::delete('post-review/{id}', 'FrontEnd\PostReviewController@storePostReview');
    Route::get('post-review/{id}', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewById');
    Route::get('post-review', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewByUser');
    
    //Comment
    Route::get('comment/{id}', 'FrontEnd\Comment\CommentController@getCommentByPostReview');
    Route::post('comment', 'FrontEnd\Comment\CommentController@commentPostReview');
    Route::post('comment/reply', 'FrontEnd\PostReviewController@storePostReview');
    Route::post('comment/{comment_id}/like', 'FrontEnd\Comment\LikeCommentController@likeComment');
    Route::post('comment/{id}/dislike', 'FrontEnd\PostReviewController@storePostReview');
    
    //Profile
    Route::get('profile/post-review', 'FrontEnd\Profile\ProfileController@myPostReview');
});

Route::get('post-review-latest-new', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewLatestNew');
Route::get('shops', 'FrontEnd\Shop\GetShopController@index');
Route::post('shops', 'FrontEnd\Shop\GetShopController@index');