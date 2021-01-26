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
 * Routes Events
 */
Route::namespace('Api\Event')->prefix('/events')->group(function () {

  Route::GET('/', 'EventController@index');
  Route::GET('/get/{id}', 'EventController@get');


  Route::middleware(['auth:api'])->group(function(){
    Route::post('/new', 'EventController@create')->middleware(['role:admin|moderator']);
    Route::POST('/edit', 'EventController@update')->middleware(['role:admin|moderator']);
    Route::POST('/delete', 'EventController@delete')->middleware(['role:admin']);
  });

});


/**
 * Routes Documents
 */
Route::namespace('Api\Document')->prefix('/documents')->group(function () {

  Route::GET('/', 'DocumentController@index');
  Route::GET('/get/{id}', 'DocumentController@get');
  Route::GET('/types', 'DocumentController@types');
  Route::POST('/download', 'DocumentController@download');

  Route::middleware(['auth:api'])->group(function(){
    Route::post('/new', 'DocumentController@create')->middleware(['role:admin|moderator']);
    Route::POST('/edit', 'DocumentController@update')->middleware(['role:admin|moderator']);
    Route::POST('/delete', 'DocumentController@delete')->middleware(['role:admin']);
  });

});


/**
 * Routes Projects
 */
Route::namespace('Api\Project')->prefix('/projects')->group(function () {

  Route::GET('/', 'ProjectController@index');
  Route::GET('/get/{id}', 'ProjectController@get');

  Route::middleware(['auth:api'])->group(function(){
    Route::post('/new', 'ProjectController@create')->middleware(['role:admin|moderator']);
    Route::POST('/edit', 'ProjectController@update')->middleware(['role:admin|moderator']);
    Route::POST('/delete', 'ProjectController@delete')->middleware(['role:admin']);

  });
});


/**
 * Routes Images
 */
Route::namespace('Api\Image')->prefix('/images')->group(function () {

  Route::GET('/', 'ImageController@index');
  Route::GET('/{id}', 'ImageController@get');
  
});


/**
 * Routes Users
 */
Route::namespace('Api\User')->prefix('/users')->group(function () {

  Route::POST('/edit', 'UserController@update')->middleware(['auth:api']);
  
});


/**
 * Routes Users
 */
Route::namespace('Api\SchoolClass')->prefix('/school-classes')->group(function () {

  Route::GET('/', 'SchoolClassController@index');
  
});