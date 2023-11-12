<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'verified', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/posts/{post}/edit', [AdminController::class, 'editPosts'])->name('admin.posts.edit');
});

Route::prefix('author-panel')->middleware(['auth', 'is_author'])->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/{post}/edit', [AuthorController::class, 'edit'])->name('authors.edit');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('/posts')->group(function () {
    Route::get('/{post}', [PostController::class, 'view'])->name('posts.view');
    Route::post('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::prefix('vote')->middleware(['auth'])->group(function () {
    Route::post('/{post}', [VoteController::class, 'vote'])->name('vote.post');
});

require __DIR__.'/auth.php';
