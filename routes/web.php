<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ChildController;
use App\Http\Controllers\Backend\BeneficiaryController;

use App\Http\Middleware\CheckRole;

// Home route
Route::get('/', fn() => view('welcome'));
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
Route::middleware(['auth:admin', CheckRole::class . ':1,'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    //banner routes
    Route::get('/banners', [BannerController::class, 'index'])->name('admin.banners.index');
    Route::get('/banners/create', [BannerController::class, 'create'])->name('admin.banners.create');
    Route::post('/banners', [BannerController::class, 'store'])->name('admin.banners.store');
    Route::get('/banners/{id}/edit', [BannerController::class, 'edit'])->name('admin.banners.edit');
    Route::put('/banners/{id}', [BannerController::class, 'update'])->name('admin.banners.update');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');

    //child 
    Route::get('/children', [ChildController::class, 'index'])->name('admin.children.index');
    Route::get('/children/create', [ChildController::class, 'create'])->name('admin.children.create');
    Route::post('/children', [ChildController::class, 'store'])->name('admin.children.store');
    Route::get('/children/{id}/edit', [ChildController::class, 'edit'])->name('admin.children.edit');
    Route::put('/children/{id}', [ChildController::class, 'update'])->name('admin.children.update');
    Route::delete('/children/{id}', [ChildController::class, 'destroy'])->name('admin.children.destroy');

    // beneficiary 
    Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('admin.beneficiaries.index');
    Route::get('/beneficiaries/create', [BeneficiaryController::class, 'create'])->name('admin.beneficiaries.create');
    Route::post('/beneficiaries', [BeneficiaryController::class, 'store'])->name('admin.beneficiaries.store');
    Route::get('/beneficiaries/{id}/edit', [BeneficiaryController::class, 'edit'])->name('admin.beneficiaries.edit');
    Route::put('/beneficiaries/{id}', [BeneficiaryController::class, 'update'])->name('admin.beneficiaries.update');
    Route::delete('/beneficiaries/{id}', [BeneficiaryController::class, 'destroy'])->name('admin.beneficiaries.destroy');

});

 