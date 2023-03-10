<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\MovieController;
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

// Route::resource('movies' , MovieController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Public routes
Route::post("register", [UserController::class, "register"]);
Route::post("login", [UserController::class, "login"]);


//Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('movies/search/{params}' , [MovieController::class , "search"]);
    Route::resource('movies' , MovieController::class);
    Route::post("logout", [UserController::class, "logout"]);
});

