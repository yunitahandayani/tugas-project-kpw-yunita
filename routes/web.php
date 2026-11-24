<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\KritikController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Publik: dashboard & list film
|--------------------------------------------------------------------------
*/
Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| User yang sudah login: komentar & profil sendiri
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/movies/{film}/kritik', [KritikController::class, 'store'])->name('kritik.store');
    Route::delete('/kritik/{kritik}', [KritikController::class, 'destroy'])->name('kritik.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Administrator
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('films', Admin\FilmController::class)->except('show')->parameters(['films' => 'film']);
    Route::resource('casts', Admin\CastController::class)->except('show')->parameters(['casts' => 'cast']);
    Route::resource('genres', Admin\GenreController::class)->except('show')->parameters(['genres' => 'genre']);
    Route::resource('perans', Admin\PeranController::class)->except('show')->parameters(['perans' => 'peran']);

    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
});
