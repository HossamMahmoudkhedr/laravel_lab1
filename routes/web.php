<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('posts', [PostController::class, 'index'])->name('post.index');
Route::get('post/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostController::class);
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post',[PostController::class, 'store'])->name('post.store');
    Route::get('post/{id}/edit',[PostController::class, 'edit'])->name('post.edit');
    Route::put('post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{id}', [PostController::class, 'destroy']);
    Route::fallback(function(){
        return response()->view('errors.404',[],404);
    });
});

require __DIR__.'/auth.php';
