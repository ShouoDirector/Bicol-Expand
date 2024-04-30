<?php

use Illuminate\Support\Facades\Route;

/*--Controllers --*/
use App\Http\Controllers\AuthorController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('author')->name('author.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login', 'backend.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'backend.pages.auth.forgot')->name('forgot-password');
    });

    Route::middleware([])->group(function(){
        Route::get('/home', [AuthorController::class, 'index'])->name('home');
    });
});
