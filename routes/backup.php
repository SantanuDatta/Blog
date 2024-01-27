<?php

use App\Http\Controllers\Backend\BackendController;
//Frontend
use App\Http\Controllers\Backend\CategoryController;
//Backend
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Home
Route::get('/', [FrontendController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| Backend Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/admin'], function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('admin.dashboard');

    //Category Route
    Route::group(['prefix' => '/category'], function () {
        Route::get('/manage', [CategoryController::class, 'index'])->name('category.manage');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    //Post Route
    Route::group(['prefix' => '/post'], function () {
        Route::get('/manage', [PostController::class, 'index'])->name('post.manage');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
        Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    });

});
