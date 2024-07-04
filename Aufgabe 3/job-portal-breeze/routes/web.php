<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostJobAdController;
use App\Http\Controllers\FindJobAdsController;
use App\Http\Controllers\EditJobAdController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('categories', CategoryController::class);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('companies', CompaniesController::class);
Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
Route::get('/companies/{id}', [CompaniesController::class, 'show'])->name('companies.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/post-jobs/create', [PostJobAdController::class, 'create'])->name('post-jobs.create');
    Route::post('/post-jobs', [PostJobAdController::class, 'store'])->name('post-jobs.store');
    Route::get('/post-jobs', [PostJobAdController::class, 'index'])->name('post-jobs.index');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/find-jobs', [FindJobAdsController::class, 'store'])->name('find-jobs.store');
    Route::get('/find-jobs/search', [FindJobAdsController::class, 'search'])->name('find-jobs.search');
    Route::get('/find-jobs', [FindJobAdsController::class, 'index'])->name('find-jobs.index');
    Route::get('/find-jobs/{id}', [FindJobAdsController::class, 'show'])->name('find-jobs.show');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/jobs', [FindJobAdsController::class, 'store'])->name('find-jobs.store');
    Route::get('/jobs', [FindJobAdsController::class, 'index'])->name('find-jobs.index');
    Route::get('/jobs/search', [FindJobAdsController::class, 'search'])->name('find-jobs.search');
    Route::get('/jobs/{id}', [FindJobAdsController::class, 'show'])->name('find-jobs.show');
});

Route::middleware(['auth'])->group(function () {
Route::get('/jobs/{id}/edit', [EditJobAdController::class, 'edit'])->name('edit-jobs.edit');
Route::put('/jobs/{id}', [EditJobAdController::class, 'update'])->name('edit-jobs.update');
Route::delete('/jobs/{id}', [EditJobAdController::class, 'destroy'])->name('edit-jobs.destroy');
});

require __DIR__.'/auth.php';
