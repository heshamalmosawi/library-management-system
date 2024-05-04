<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
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
    return view('home');
});

Route::get("/login", [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post("/login", [RegisterController::class, 'register'])->name('register');


