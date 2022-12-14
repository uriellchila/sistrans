<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
  "prefix"=>"v1",
  //"namespace"=>"\Api\V1",
  //"middleware"=>['post:api']
], function(){
  Route::apiResource('posts',PostController::class);
});

Route::controller(AuthController::class)->group(function () {
  Route::post('login', 'login');
  Route::post('signup', 'signup');
});
