<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
//Route admin - Articles
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('article.index');
    Route::get('/admin/articles/create', [\App\Http\Controllers\ArticleController::class, 'create'])->name('article.create');
    Route::post('/admin/articles/store', [\App\Http\Controllers\ArticleController::class, 'store'])->name('article.store');
    Route::get('/admin/articles/edit/{id}', [\App\Http\Controllers\ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/admin/articles/update/{id}', [\App\Http\Controllers\ArticleController::class, 'update'])->name('article.update');
    Route::get('/admin/articles/show/{id}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');
    Route::get('/admin/articles/destroy/{id}', [\App\Http\Controllers\ArticleController::class, 'destroy'])->name('article.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
