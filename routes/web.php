<?php

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
    if (Auth::user()) {
        // if(Auth::user()->user_type != 5 && Auth::user()->user_type != 4){
            return redirect()->intended('/home');
        // }elseif(Auth::user()->user_type == 5){
        //     return redirect()->intended('/myprofile');
        // }
    }else {
        return redirect()->intended('/login');
    }
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login');

Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'register_view'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register_view');
