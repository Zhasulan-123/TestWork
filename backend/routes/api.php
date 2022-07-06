<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Page\PageController;
use App\Http\Controllers\Api\Auth\LoginController;

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

Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('pages', [PageController::class, 'page']);
    Route::get('page/{id}', [PageController::class, 'pageById']);
    Route::post('page', [PageController::class, 'pageSave']);
    Route::put('page/{id}', [PageController::class, 'pageEdit']);
    Route::delete('page/{id}', [PageController::class, 'pageDelete']);
    Route::get('refresh', [LoginController::class, 'refresh']);
});