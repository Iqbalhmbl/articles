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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/articles',[\App\Http\Controllers\API\ApiArticleController::class, 'article'])->name('article');
Route::get('/detail-article/{id}',[\App\Http\Controllers\API\ApiArticleController::class, 'detailarticle'])->name('detailarticle');
