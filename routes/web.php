<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('feed', FeedController::class)->middleware('auth')->name('feed');

Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware(['auth','can:admin'])->name('admin.dashboard');

Route::get('lang/{lang}', function ($lang){
    app()->setlocale($lang);
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');
