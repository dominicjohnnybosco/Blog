<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;

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
    return view('welcome');
});

//controller route
Route::resource('posts', PostsController::class);

// registration controller
Route::resource('register', RegisterController::class)->only([
    'store', 'create'
])->middleware('guest');

//Sessions Route
Route::get('/login', [SessionsController::class,'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionsController::class,'store'])->name('login');
Route::post('/logout',[SessionsController::class,'destroy'])->name('logout')->middleware('auth');

//Dashboard Route
Route::get('/profile',[DashboardController::class,'index'])->name('dashboard')->middleware('auth');
