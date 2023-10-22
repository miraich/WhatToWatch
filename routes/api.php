<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/login', [AuthController::class, 'get_login'])->name('auth.get_login');
// несоотв. ТЗ

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');

Route::get('/films/{film}/similar', [FilmController::class, 'similar'])->name('films.similar');
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/films/{film}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/promo', [PromoController::class, 'show'])->name('promo.show');

Route::middleware('auth:sanctum')->group(function () {

    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    Route::patch('/user', [UserController::class, 'update'])->name('user.update');

    // Можно использовать ресурсный роут, вместо перечисления каждого отдельно
//    Route::apiResource('films', FilmController::class)->except('destroy');
    Route::post('/films', [FilmController::class, 'store'])->name('films.store');
    Route::patch('/films/{film}', [FilmController::class, 'update'])->name('films.update');

    Route::patch('/genres/{genre}', [GenreController::class, 'update'])->name('genres.update');

    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/films/{film}/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/films/{film}/favorite', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    Route::post('/films/{film}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/promo/{film}', [PromoController::class, 'store'])->name('promo.store');
});
