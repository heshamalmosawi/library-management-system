<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get("/register", [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post("/register", [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// change this to middleware for authentication
Route::get('/addbook', [BookController::class, 'showAddForm'])->name('addbook');
Route::post('/addbook', [BookController::class, 'addBook'])->name('addbook');

Route::get('/books', [BookController::class, 'allBooksPage'])->name('allBooksPage');
Route::get('/category', [BookController::class, 'showCategories'])->name('showCategories');
// routes/web.php
Route::get('/category/{category}', [BookController::class, 'showBooksByCategory'])->name('showBooksByCategory');
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfileForm'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
});