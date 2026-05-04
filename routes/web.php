<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IkanController;
use App\Http\Controllers\EkosistemController;
use App\Http\Controllers\AksiController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FishController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');

Route::get('/ikan', [IkanController::class, 'index'])->name('ikan.index');
Route::get('/ikan/create', [IkanController::class, 'create'])->middleware('auth')->name('ikan.create');
Route::get('/ikan/{id}', [IkanController::class, 'show'])->name('ikan.show');
Route::get('/ikan/{id}/edit', [IkanController::class, 'edit'])->middleware('auth')->name('ikan.edit');
Route::post('/ikan', [IkanController::class, 'store'])->middleware('auth')->name('ikan.store');
Route::put('/ikan/{id}', [IkanController::class, 'update'])->middleware('auth')->name('ikan.update');
Route::delete('/ikan/{id}', [IkanController::class, 'destroy'])->middleware('auth')->name('ikan.destroy');

Route::resource('ekosistem', EkosistemController::class);

Route::get('/aksi', [AksiController::class, 'index'])->name('aksi.index');
Route::get('/aksi/create', [AksiController::class, 'create'])->middleware('auth')->name('aksi.create');
Route::get('/aksi/{id}', [AksiController::class, 'show'])->name('aksi.show');
Route::get('/aksi/{id}/edit', [AksiController::class, 'edit'])->middleware('auth')->name('aksi.edit');
Route::post('/aksi', [AksiController::class, 'store'])->middleware('auth')->name('aksi.store');
Route::put('/aksi/{id}', [AksiController::class, 'update'])->middleware('auth')->name('aksi.update');
Route::delete('/aksi/{id}', [AksiController::class, 'destroy'])->middleware('auth')->name('aksi.destroy');

Route::post('/favorites', [FavoriteController::class, 'store'])->middleware('auth')->name('favorites.store');
Route::delete('/favorites', [FavoriteController::class, 'destroy'])->middleware('auth')->name('favorites.destroy');
Route::get('/favorites', [FavoriteController::class, 'index'])->middleware('auth')->name('favorites.index');
Route::get('/bookmarks', [FavoriteController::class, 'bookmarks'])->middleware('auth')->name('bookmarks.index');

Route::get('/likes', [LikeController::class, 'index'])->middleware('auth')->name('likes.index');
Route::post('/likes', [LikeController::class, 'store'])->middleware('auth')->name('likes.store');
Route::delete('/likes', [LikeController::class, 'destroy'])->middleware('auth')->name('likes.destroy');
Route::get('/likes/{actionId}/count', [LikeController::class, 'count'])->name('likes.count');

Route::get('/search/ikan', [SearchController::class, 'searchIkan'])->name('search.ikan');
Route::get('/search/ekosistem', [SearchController::class, 'searchEkosistem'])->name('search.ekosistem');
Route::get('/search/aksi', [SearchController::class, 'searchAksi'])->name('search.aksi');

// Fish routes (uses Local Storage via JS, no DB)
Route::get('/fish', [FishController::class, 'index'])->name('fish.index');
Route::get('/fish/detail', [FishController::class, 'detail'])->name('fish.detail');

// Note: Using only IkanController for /ikan routes (removed fish resource)

Route::get('/dashboard', function () {
    $user = auth()->user();
    return view('dashboard', [
        'bookmarkCount' => $user->favorites()->count(),
        'likeCount' => $user->likes()->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
