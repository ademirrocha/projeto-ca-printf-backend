<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Auth Routes
 */
Route::namespace('Api\Auth')->prefix('/auth')->group(function () {
  /* Login Routes */
  Route::post('/login', 'LoginController@login');
  Route::post('/logout', 'LoginController@logout')->middleware(['auth:api']);

  
  //#UserCreate
  Route::post('/register', 'RegisterController@create'); 
  //Route::post('/email/resend', 'VerificationController@resend');
  //Route::post('/email/verify', 'VerificationController@verify');

  /* Password Reset Routes */
  //Route::post('password/email', 'ResetPasswordController@sendResetLinkEmail');
  //Route::post('password/reset', 'ResetPasswordController@reset');

});


/**
 * Auth Events
 */
Route::namespace('Api\Event')->prefix('/events')->group(function () {

  Route::GET('/', 'EventController@get');
  Route::post('/new', 'EventController@create')->middleware(['auth:api']);

});


/**
 * Auth Documents
 */
Route::namespace('Api\Document')->prefix('/documents')->group(function () {

  Route::GET('/', 'DocumentController@get');
  Route::get('/download', 'DocumentController@download');
  Route::post('/new', 'DocumentController@create')->middleware(['auth:api']);

});