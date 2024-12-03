<?php

use App\Http\Controllers\ComnetController;
use App\Http\Controllers\likecontroller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Comnet;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__.'/auth.php';
Route::get('/{user:username}', [UserController::class,'index'])->name('user_profile');

Route::get('/p/explore' , [PostController::class , 'explore'])->name('explore');
Route::middleware('auth')->group(function () {
    Route::patch('/{user:username}/update' , [UserController::class , 'update']);
    Route::get('/{user:username}/edit' , [UserController::class , 'edit'])->name('edit_profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/p/create' , [PostController::class , 'create'])->name('create_post');
    Route::post('/p/create' , [PostController::class , 'store'])->name('store_post');
    Route::get('/p/{post:slug}',[PostController::class , 'show']);
    Route::post('/p/{post:slug}/comnite' , [ComnetController::class , 'store'])->name('comnite_store');
    Route::get('/p/{post:slug}/edit',[PostController::class , 'edit'])->name('edit_post');
    Route::patch('/p/{post:slug}/update',[PostController::class,'update'])->name('update_post');
    Route::delete("/p/{post:slug}/Delete" , [PostController::class , 'destroy']);
    Route::get('/'  , [PostController::class , 'index'])->name("home_page");
    Route::get('/p/{post:slug}/like' , likecontroller::class );
    Route::get('/{user:username}/follow' , [UserController::class , 'follow'])->name('follow_user');
    Route::get('/{user:username}/unfollow' , [UserController::class , 'unfollow'])->name('unfollow_user');
});


