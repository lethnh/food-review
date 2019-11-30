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
    Route::get('auth/comment', 'FrontEnd\Profile\ProfileController@getComment');
    Route::post('auth/avatar', 'FrontEnd\Profile\ProfileController@uploadAvatar');
    Route::post('auth/edit', 'FrontEnd\Profile\ProfileController@editUser');

    // Post Review
    Route::post('post-review', 'FrontEnd\PostReview\CreatePostReviewController@storePostReview');
    Route::post('post-review/{id}', 'FrontEnd\PostReview\EditPostReviewController@editPostReview');
    Route::delete('post-review/{id}', 'FrontEnd\PostReviewController@storePostReview');

    Route::delete('post-review/{id}/delete-image', 'FrontEnd\PostReview\EditPostReviewController@deleteImage');



    //Comment
    Route::get('comment/{id}', 'FrontEnd\Comment\CommentController@getCommentByPostReview');
    Route::post('comment', 'FrontEnd\Comment\CommentController@commentPostReview');
    Route::post('comment/reply', 'FrontEnd\PostReviewController@storePostReview');
    Route::post('comment/{comment_id}/like', 'FrontEnd\Comment\LikeCommentController@likeComment');
    Route::post('comment/{id}/dislike', 'FrontEnd\PostReviewController@storePostReview');


    //Profile
    Route::get('profile/post-review', 'FrontEnd\Profile\ProfileController@myPostReview');
});







Route::get('shops', 'FrontEnd\Shop\GetShopController@index');
Route::get('shop/post-review', 'FrontEnd\Shop\GetShopController@getShopHasManyPostReview');
Route::get('shop/new', 'FrontEnd\Shop\GetShopController@getShopNew');
Route::get('shop/{id}/list-post', 'FrontEnd\Shop\GetShopController@getPostReview');
Route::get('shop/{id}/relate', 'FrontEnd\Shop\GetShopController@getShopRelate');
Route::get('shop/{id}/comments', 'FrontEnd\Shop\GetShopController@getComments');
Route::get('shop/{id}/images', 'FrontEnd\Shop\GetShopController@getImages');
Route::get('shop/{id}', 'FrontEnd\Shop\GetShopController@getShop');
Route::get('shop/{id}/tags', 'FrontEnd\Shop\GetShopController@getShopTags');


Route::get('post-review', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewByUser');
Route::get('post-review/{id}', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewById');
Route::get('post-review', 'FrontEnd\PostReview\CreatePostReviewController@getListPostReview');
Route::get('post-review-latest-new', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewLatestNew');
Route::get('post-review-has-many-comment', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewTopComment');
Route::get('post-review-has-many-view', 'FrontEnd\PostReview\GetPostReviewController@getPostReviewTopView');
Route::get('cities', 'FrontEnd\City_District_Controller@getCities');



Route::get('search', 'FrontEnd\SearchController@postSearch');


Route::post('admin/auth/login', 'Auth\AuthController@loginAdmin');

Route::group(['middleware' => ['auth:api']], function () {
    
    Route::get('/admin/auth/check', 'Auth\AuthController@checkAdmin');
    Route::get('/auth/check', 'Auth\AuthController@checkUser');

    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
        Route::get('/info', 'Auth\AuthController@getAdmin');
        Route::get('/user', 'Auth\GetUserController@getUsers');
        Route::post('/user/create', 'BackEnd\User\UserController@store');
        Route::post('/user/block', 'BackEnd\User\UserController@block');


        Route::get('/post-review', 'BackEnd\PostReview\PostReviewController@getListPostReview');
        Route::get('/post/{id}', 'BackEnd\PostReview\PostReviewController@getPostReview');
        Route::post('/post-review', 'BackEnd\PostReview\PostReviewController@store');
        Route::post('/post-review/{id}/approve', 'BackEnd\PostReview\PostReviewController@approve');


        Route::get('/shop', 'BackEnd\Shop\ShopController@getShops');
        Route::get('/shop/{id}', 'BackEnd\Shop\ShopController@store');
        Route::post('/shop/create', 'BackEnd\Shop\ShopController@store');
        Route::post('/shop/{id}/delete', 'BackEnd\Shop\ShopController@delete');
    });
});
