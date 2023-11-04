<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\PostController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::controller(AuthorController::class)->prefix('author')->group(function () {
    Route::post('registration', 'registerAuthor');
    Route::post('login', 'loginAuthor');

    Route::middleware('api_author')->group(function () {
        Route::get('get', 'getAuthor');
    });
});

Route::controller(PostController::class)->prefix('post')->group(function () {
    Route::middleware('api_author')->group(function () {
        Route::post('add', 'addPost');
        Route::get('{post_id}/detail', 'detailPost');
        Route::post('{post_id}/update', 'updatePost');
        Route::get('{post_id}/delete', 'deletePost');
        Route::get('my/list', 'myListPost');
    });
    Route::get('all/list', 'allPost');
});
