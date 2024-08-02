<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

require base_path('routes/Auth.php');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('idea', IdeaController::class)->except(['index','create'])->middleware('auth');

Route::resource('idea', IdeaController::class)->only(['show']);

Route::resource('idea.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['show']);
Route::resource('users', UserController::class)->only(['edit','update'])->middleware('auth');

Route::get('profile', [UserController::class,'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow',[FollowerController::class,'follow'])->middleware('auth')->name('users.follow');

Route::post('users/{user}/unfollow',[FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('idea/{idea}/like',[IdeaLikeController::class,'like'])->middleware('auth')->name('idea.like');

Route::post('idea/{idea}/unlike',[IdeaLikeController::class,'unlike'])->middleware('auth')->name('idea.unlike');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');
