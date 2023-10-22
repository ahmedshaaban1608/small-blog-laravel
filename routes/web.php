<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
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




Route::get('/', [SliderController::class, 'getAll'])->name('Landing.home');

// -------------------------- Posts --------------------- // 

Route::resource('posts', PostsController::class)->Middleware('restrict.keyword');
// ---------------------- Category ------------------------
Route::resource('categories', CategoriesController::class)->Middleware('restrict.keyword');
Auth::routes();
Route::resource('users', UserController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('myProfile',[UserController::class,'profile'])->name('users.profile')->middleware('auth');


// ------------------------ Contact -------------------- //
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('sendEmail');
