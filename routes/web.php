<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileHandler;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FolowsController;
use Illuminate\Support\Facades\Route;
use App\Models\Profile;
use App\Models\User;
use App\Mail\NewUserWelcomeMail;
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



Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email', function(){
    return new NewUserWelcomeMail();
});

Route::post('/follow/{user}', [FolowsController::class, 'store'])->name('post.store');

Route::get('/profile/{user}', [ProfileHandler::class, 'index'])->middleware(['auth', 'verified'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileHandler::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}/', [ProfileHandler::class, 'update'])->name('profile.update')->middleware('auth');


Route::get('/', [PostsController::class, 'index'])->name('post.index');;
Route::get('/p/create', [PostsController::class, 'create'])->name('post.show');
Route::post('/p', [PostsController::class, 'store'])->name('post.store');
Route::get('/p/{photo}', [PostsController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
