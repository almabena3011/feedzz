<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
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



Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Auth::routes();

Route::get('@{username}', [UserController::class, 'show']);




Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('user/edit', [UserController::class, 'edit']);
    Route::put('user/edit', [UserController::class, 'update']);
    Route::resource('/post', PostController::class);
    Route::get('/follow/{user_id}', [UserController::class, 'follow']);
    Route::get('/like/{type}/{post_id}', [LikeController::class, 'toggle']);
    Route::get('/search', [HomeController::class, 'search']);

    Route::resource('post.comment', CommentController::class)->shallow();
    //Commentar
    // Route::post('comment/{post_id}', [CommentController::class, 'store']);
    // Route::get('comment/{comment_id}/edit', [CommentController::class, 'edit']);
    // Route::put('comment/{comment_id}', [CommentController::class, 'update']);
    // Route::get('comment/{comment_id}/delete', [CommentController::class, 'delete']);

    Route::get('/notification', [UserController::class, 'notification']);
    Route::get('/notification/seen',  [UserController::class, 'notificationSeen']);
    Route::get('/notification/count',  [UserController::class, 'notificationCount']);

    Route::get('/comment/{id}/report', [ReportController::class, 'report']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/users', [DashboardController::class, 'userlist']);

    Route::get('/findfriends', [HomeController::class, 'findfriends']);
    Route::get('image/{filename}', [HomeController::class, 'displayImage'])->name('image.displayImage');
});



Route::get('/loadmore/{time}', [HomeController::class, 'loadmore']);
