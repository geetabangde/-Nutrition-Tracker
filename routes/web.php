<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ChildController;
use App\Http\Controllers\Backend\BeneficiaryController;
use App\Http\Controllers\Backend\StateManagerController;
use App\Http\Controllers\Backend\RegionalManagerController;
use App\Http\Controllers\Backend\ProjectManagerController;
use App\Http\Controllers\Backend\AnganwadiOperatorController;
use App\Http\Controllers\StateManagerDashboardController;
use App\Http\Controllers\RegionalManagerDashboardController;
use App\Http\Controllers\ProjectManagerDashboardController;
use App\Http\Controllers\AnganwadiOperatorDashboardController;
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
    
    // state-manager
    Route::get('/admin/state-manager', [StateManagerController::class, 'listStateManager'])->name('admin.state-manager.list');
    Route::delete('/admin/state-manager/{id}', [StateManagerController::class,'deleteStateManager'])->name('admin.state-manager.delete');
    Route::get('/admin/state-manager/create', [StateManagerController::class,'createStateManager'])->name('admin.state-manager.create'); 
    Route::post('/admin/state-manager/create', [StateManagerController::class,'storeStateManager'])->name('admin.state-manager.store');
    Route::get('/admin/state-manager', [StateManagerController::class, 'listStateManagers'])->name('admin.state-manager.list');
    Route::delete('/admin/state-manager/{id}', [StateManagerController::class,'deleteStateManager'])->name('admin.state-manager.delete'); 
    Route::get('/admin/state-manager/{id}/edit', [StateManagerController::class,'editStateManager'])->name('admin.state-manager.edit');
    Route::put('/admin/state-manager/{id}', [StateManagerController::class,'updateStateManager'])->name('admin.state-manager.update');
    
    // regional-manager
    Route::get('/admin/regional-manager', [RegionalManagerController::class, 'listRegionalManager'])->name('admin.regional-manager.list');
    Route::delete('/admin/regional-manager/{id}', [RegionalManagerController::class,'deleteRegionalManager'])->name('admin.regional-manager.delete');
    Route::get('/admin/regional-manager/create', [RegionalManagerController::class,'createRegionalManager'])->name('admin.regional-manager.create'); 
    Route::post('/admin/regional-manager/create', [RegionalManagerController::class,'storeRegionalManager'])->name('admin.regional-manager.store');
    Route::get('/admin/regional-manager', [RegionalManagerController::class, 'listRegionalManagers'])->name('admin.regional-manager.list');
    Route::delete('/admin/regional-manager/{id}', [RegionalManagerController::class,'deleteRegionalManager'])->name('admin.regional-manager.delete'); 
    Route::get('/admin/regional-manager/{id}/edit', [RegionalManagerController::class,'editRegionalManager'])->name('admin.regional-manager.edit');
    Route::put('/admin/regional-manager/{id}', [RegionalManagerController::class,'updateRegionalManager'])->name('admin.regional-manager.update');

    // project-manager
    Route::get('/admin/project-manager', [ProjectManagerController::class, 'listProjectManager'])->name('admin.project-manager.list');
    Route::delete('/admin/project-manager/{id}', [ProjectManagerController::class,'deleteProjectManager'])->name('admin.project-manager.delete');
    Route::get('/admin/project-manager/create', [ProjectManagerController::class,'createProjectManager'])->name('admin.project-manager.create'); 
    Route::post('/admin/project-manager/create', [ProjectManagerController::class,'storeProjectManager'])->name('admin.project-manager.store');
    Route::get('/admin/project-manager', [ProjectManagerController::class, 'listProjectManagers'])->name('admin.project-manager.list');
    Route::delete('/admin/project-manager/{id}', [ProjectManagerController::class,'deleteProjectManager'])->name('admin.project-manager.delete'); 
    Route::get('/admin/project-manager/{id}/edit', [ProjectManagerController::class,'editProjectManager'])->name('admin.project-manager.edit');
    Route::put('/admin/project-manager/{id}', [ProjectManagerController::class,'updateProjectManager'])->name('admin.project-manager.update');

    // anganwadi-operator
    Route::get('/admin/anganwadi-operator', [AnganwadiOperatorController::class, 'listAnganwadiOperator'])->name('admin.anganwadi-operator.list');
    Route::delete('/admin/anganwadi-operator/{id}', [AnganwadiOperatorController::class,'deleteAnganwadiOperator'])->name('admin.anganwadi-operator.delete');
    Route::get('/admin/anganwadi-operator/create', [AnganwadiOperatorController::class,'createAnganwadiOperator'])->name('admin.anganwadi-operator.create'); 
    Route::post('/admin/anganwadi-operator/create', [AnganwadiOperatorController::class,'storeAnganwadiOperator'])->name('admin.anganwadi-operator.store');
    Route::get('/admin/anganwadi-operator', [AnganwadiOperatorController::class, 'listAnganwadiOperators'])->name('admin.anganwadi-operator.list');
    Route::delete('/admin/anganwadi-operator/{id}', [AnganwadiOperatorController::class,'deleteAnganwadiOperator'])->name('admin.anganwadi-operator.delete'); 
    Route::get('/admin/anganwadi-operator/{id}/edit', [AnganwadiOperatorController::class,'editAnganwadiOperator'])->name('admin.anganwadi-operator.edit');
    Route::put('/admin/anganwadi-operator/{id}', [AnganwadiOperatorController::class,'updateAnganwadiOperator'])->name('admin.anganwadi-operator.update');
});

Route::middleware(['auth:admin', CheckRole::class . ':2'])->group(function () {
    Route::get('/state-manager/dashboard', [StateManagerDashboardController::class, 'index'])->name('state-manager.dashboard');
});
Route::middleware(['auth:admin', CheckRole::class . ':3'])->group(function () {
    Route::get('/regional-manager/dashboard', [RegionalManagerDashboardController::class, 'index'])->name('regional-manager.dashboard');
});

Route::middleware(['auth:admin', CheckRole::class . ':4'])->group(function () {
    Route::get('/project-manager/dashboard', [ProjectManagerDashboardController::class, 'index'])->name('project-manager.dashboard');
});

Route::middleware(['auth:admin', CheckRole::class . ':5'])->group(function () {
    Route::get('/anganwadi-operator/dashboard', [AnganwadiOperatorDashboardController::class, 'index'])->name('anganwadi-operator.dashboard');
});