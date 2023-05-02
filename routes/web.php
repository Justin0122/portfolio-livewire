<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
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
})->name('welcome');


if (auth()->check()) {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
} else {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('home');
}

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::middleware('auth')->group(function () {
    Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
});

Route::get('/project/{project}', [ProjectsController::class, 'show'])->name('projects.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/spotify', function () {
    return view('spotify');
})->name('spotify');


require __DIR__ . '/auth.php';
