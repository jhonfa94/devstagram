<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
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
    // return view('welcome');
    return view('principal');
});

Route::get('/register', [RegisterController::class,'index'])->name('register.index');
Route::post('/register', [RegisterController::class,'store'])->name('register.store');


Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login.store');
Route::post('/logout', [LogoutController::class,'store'])->name('logout');

Route::get('/{user:username}', [PostController::class,'index'])->name('post.index');
Route::get('/post/create', [PostController::class,'create'])->name('post.create');
Route::post('/posts', [PostController::class,'store'])->name('post.store');


Route::post('/imagenes', [ImageController::class,'store'])->name('imagenes.store');
