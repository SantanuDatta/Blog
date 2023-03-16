<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Frontend
use App\Http\Controllers\Frontend\FrontendController;

//Backend
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\EditorController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ReaderController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubscriberController;

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

//Home
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::group(['prefix' => '/blogs'], function () {
    Route::get('/', [FrontendController::class, 'blogs'])->name('blogs');
    Route::get('/single-post/{slug}', [FrontendController::class, 'singlePost'])->name('singlePost');
    Route::post('/comments', [CommentController::class, 'store'])->name('post.comment');
    Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
    Route::get('/tags/{tagName}', [FrontendController::class, 'tagPost'])->name('tagPost');
    Route::get('/category/{slug}', [FrontendController::class, 'categoryPost'])->name('categoryPost');
    Route::any('/search-posts', [FrontendController::class, 'searchPost'])->name('search.posts');
});
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');


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

Route::middleware(['auth', 'role'])->group(function () {
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
            Route::post('/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
            Route::post('/browse', [PostController::class, 'browse'])->name('ckeditor.browse');
            Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
            Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
            Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
        });

        //Editor Route
        Route::group(['prefix' => '/editor'], function () {
            Route::get('/manage', [EditorController::class, 'index'])->name('editor.manage');
            Route::get('/create', [EditorController::class, 'create'])->name('editor.create');
            Route::post('/store', [EditorController::class, 'store'])->name('editor.store');
            Route::get('/edit/{id}', [EditorController::class, 'edit'])->name('editor.edit');
            Route::post('/update/{id}', [EditorController::class, 'update'])->name('editor.update');
            Route::post('/destroy/{id}', [EditorController::class, 'destroy'])->name('editor.destroy');
        });

        //Reader Route
        Route::group(['prefix' => '/reader'], function () {
            Route::get('/manage', [ReaderController::class, 'index'])->name('reader.manage');
            Route::get('/create', [ReaderController::class, 'create'])->name('reader.create');
            Route::post('/store', [ReaderController::class, 'store'])->name('reader.store');
            Route::get('/edit/{id}', [ReaderController::class, 'edit'])->name('reader.edit');
            Route::post('/update/{id}', [ReaderController::class, 'update'])->name('reader.update');
            Route::post('/destroy/{id}', [ReaderController::class, 'destroy'])->name('reader.destroy');
        });

        //Comment Route
        Route::group(['prefix' => '/comment'], function () {
            Route::get('/manage', [CommentController::class, 'index'])->name('comment.manage');
            Route::get('/details/{id}', [CommentController::class, 'show'])->name('comment.show');
            Route::post('/update/{id}', [CommentController::class, 'update'])->name('comment.update');
            Route::post('/destroy/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
        });

        //Subscriber Route
        Route::group(['prefix' => '/subscriber'], function () {
            Route::get('/manage', [SubscriberController::class, 'index'])->name('subscriber.manage');
            Route::post('/destroy/{id}', [SubscriberController::class, 'destroy'])->name('subscriber.destroy');
        });

        //Setting Route
        Route::group(['prefix' => '/setting'], function () {
            Route::get('/manage', [SettingController::class, 'index'])->name('setting.manage');
            Route::post('/update/{id}', [SettingController::class, 'update'])->name('setting.update');
        });

    });
});

require __DIR__ . '/auth.php';
