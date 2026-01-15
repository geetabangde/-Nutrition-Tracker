<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ChildController;
use App\Http\Controllers\Backend\BeneficiaryController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\StateManagerController;
use App\Http\Controllers\Backend\RegionalManagerController;
use App\Http\Controllers\Backend\ProjectManagerController;
use App\Http\Controllers\Backend\AnganwadiOperatorController;
use App\Http\Controllers\StateManagerDashboardController;
use App\Http\Controllers\RegionalManagerDashboardController;
use App\Http\Controllers\ProjectManagerDashboardController;

// Home route
Route::get('/', fn() => view('welcome'));

// Admin Login Routes (No Auth Required)
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

// All Admin Authenticated Routes
Route::middleware(['auth:admin'])->group(function () {
    
    // Dashboard - Accessible by all roles
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // ============================================
    // SUPER ADMIN ONLY (Role ID: 1)
    // ============================================
    Route::middleware(['role:1'])->group(function () {
        
        // Banner Routes
        Route::prefix('banners')->name('admin.banners.')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerController::class, 'create'])->name('create');
            Route::post('/', [BannerController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BannerController::class, 'update'])->name('update');
            Route::delete('/{id}', [BannerController::class, 'destroy'])->name('destroy');
        });

        // Children Routes
        Route::prefix('children')->name('admin.children.')->group(function () {
            Route::get('/', [ChildController::class, 'index'])->name('index');
            Route::get('/create', [ChildController::class, 'create'])->name('create');
            Route::post('/', [ChildController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ChildController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ChildController::class, 'update'])->name('update');
            Route::delete('/{id}', [ChildController::class, 'destroy'])->name('destroy');
        });

        // Beneficiary Routes
        Route::prefix('beneficiaries')->name('admin.beneficiaries.')->group(function () {
            Route::get('/', [BeneficiaryController::class, 'index'])->name('index');
            Route::get('/create', [BeneficiaryController::class, 'create'])->name('create');
            Route::post('/', [BeneficiaryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BeneficiaryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BeneficiaryController::class, 'update'])->name('update');
            Route::delete('/{id}', [BeneficiaryController::class, 'destroy'])->name('destroy');
        });

        // Video Routes
        Route::prefix('videos')->name('admin.videos.')->group(function () {
            Route::get('/', [VideoController::class, 'index'])->name('index');
            Route::get('/create', [VideoController::class, 'create'])->name('create');
            Route::post('/', [VideoController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [VideoController::class, 'edit'])->name('edit');
            Route::put('/{id}', [VideoController::class, 'update'])->name('update');
            Route::delete('/{id}', [VideoController::class, 'destroy'])->name('destroy');
        });

        // State Manager Routes (Admin Only)
        Route::prefix('admin/state-manager')->name('admin.state-manager.')->group(function () {
            Route::get('/', [StateManagerController::class, 'listStateManagers'])->name('list');
            Route::get('/create', [StateManagerController::class, 'createStateManager'])->name('create');
            Route::post('/create', [StateManagerController::class, 'storeStateManager'])->name('store');
            Route::get('/{id}/edit', [StateManagerController::class, 'editStateManager'])->name('edit');
            Route::put('/{id}', [StateManagerController::class, 'updateStateManager'])->name('update');
            Route::delete('/{id}', [StateManagerController::class, 'deleteStateManager'])->name('delete');
        });
    });

    // ============================================
    // ADMIN + STATE MANAGER (Role IDs: 1, 2)
    // ============================================
    Route::middleware(['role:1,2'])->group(function () {
        // Regional Manager Routes
        Route::prefix('admin/regional-manager')->name('admin.regional-manager.')->group(function () {
            Route::get('/', [RegionalManagerController::class, 'listRegionalManagers'])->name('list');
            Route::get('/create', [RegionalManagerController::class, 'createRegionalManager'])->name('create');
            Route::post('/create', [RegionalManagerController::class, 'storeRegionalManager'])->name('store');
            Route::get('/{id}/edit', [RegionalManagerController::class, 'editRegionalManager'])->name('edit');
            Route::put('/{id}', [RegionalManagerController::class, 'updateRegionalManager'])->name('update');
            Route::delete('/{id}', [RegionalManagerController::class, 'deleteRegionalManager'])->name('delete');
        });
    });

    // ============================================
    // ADMIN + STATE + REGIONAL MANAGER (Role IDs: 1, 2, 3)
    // ============================================
    Route::middleware(['role:1,2,3'])->group(function () {
        // Project Manager Routes
        Route::prefix('admin/project-manager')->name('admin.project-manager.')->group(function () {
            Route::get('/', [ProjectManagerController::class, 'listProjectManagers'])->name('list');
            Route::get('/create', [ProjectManagerController::class, 'createProjectManager'])->name('create');
            Route::post('/create', [ProjectManagerController::class, 'storeProjectManager'])->name('store');
            Route::get('/{id}/edit', [ProjectManagerController::class, 'editProjectManager'])->name('edit');
            Route::put('/{id}', [ProjectManagerController::class, 'updateProjectManager'])->name('update');
            Route::delete('/{id}', [ProjectManagerController::class, 'deleteProjectManager'])->name('delete');
        });
    });

    // ============================================
    // ALL MANAGERS (Role IDs: 1, 2, 3, 4)
    // ============================================
    Route::middleware(['role:1,2,3,4'])->group(function () {
        // Anganwadi Operator Routes
        Route::prefix('admin/anganwadi-operator')->name('admin.anganwadi-operator.')->group(function () {
            Route::get('/', [AnganwadiOperatorController::class, 'listAnganwadiOperators'])->name('list');
            Route::get('/create', [AnganwadiOperatorController::class, 'createAnganwadiOperator'])->name('create');
            Route::post('/create', [AnganwadiOperatorController::class, 'storeAnganwadiOperator'])->name('store');
            Route::get('/{id}/edit', [AnganwadiOperatorController::class, 'editAnganwadiOperator'])->name('edit');
            Route::put('/{id}', [AnganwadiOperatorController::class, 'updateAnganwadiOperator'])->name('update');
            Route::delete('/{id}', [AnganwadiOperatorController::class, 'deleteAnganwadiOperator'])->name('delete');
        });
    });

    // ============================================
    // ROLE-SPECIFIC DASHBOARDS
    // ============================================
    
    // State Manager Dashboard (Role ID: 2)
    Route::middleware(['role:2'])->group(function () {
        Route::get('/state-manager/dashboard', [StateManagerDashboardController::class, 'index'])
            ->name('state-manager.dashboard');
    });

    // Regional Manager Dashboard (Role ID: 3)
    Route::middleware(['role:3'])->group(function () {
        Route::get('/regional-manager/dashboard', [RegionalManagerDashboardController::class, 'index'])
            ->name('regional-manager.dashboard');
    });

    // Project Manager Dashboard (Role ID: 4)
    Route::middleware(['role:4'])->group(function () {
        Route::get('/project-manager/dashboard', [ProjectManagerDashboardController::class, 'index'])
            ->name('project-manager.dashboard');
    });
});