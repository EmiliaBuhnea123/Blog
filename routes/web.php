<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Article;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::resource('pages', ArticleController::class)
    ->only(['index', 'show', 'create', 'edit', 'destroy', 'update', 'store']);

Route::resource('pages.comments', CommentController::class)
    ->only(['index', 'show', 'store', 'destroy']);

Route::get('/', [ArticleController::class, 'indexAll'])->name('home');

Route::get('/admin/profiles', [AdminController::class, 'index'])->name('admin.profiles');
Route::resource('admin', AdminController::class)
    ->only(['index', 'create', 'destroy', 'store']);


Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeRegister')->name('register.store');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'storeLogin')->name('login.store');
    Route::delete('/logout', 'logout')->name('logout');
});

Route::get('/profile', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
