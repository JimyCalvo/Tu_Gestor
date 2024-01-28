<?php

/**
 * This file contains the API routes for the application.
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\
{
    LoginController,
    LogoutController,
    VerificationController,
    RegisterController
};
use App\Http\Controllers\Api\Auth\Passwords\
{
    ForgotPasswordController,
    ResetPasswordController
};

use App\Http\Controllers\Api\
{
    ProfileController,
    UserController,
    AreaController,
    RepositoryController,
    InventoryController,
    CategoryController,
    ManufacturerController,
    SupplierController,
    ItemDataController,
    ItemController,
    OtherController,
    ItemHistoryController,
    UserInfoController,
    ExcelExportController,
    ItemSearchController,
};

/**
 * Register routes
 */
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

/**
 * Login routes
 */
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

/**
 * Profile routes
 */
Route::post('/profile/create', [ProfileController::class,'store'])->name('profile.store');

/**
 * Email verification routes
 */
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/verification-resend', [VerificationController::class, 'resend'])->name('verification.resend');

/**
 * Password reset routes
 */
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

/**
 * Authenticated routes
 */
Route::middleware('auth:sanctum')->group(function () {

    /**
     * Logout route
     */
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    /**
     * User info route
     */
    Route::get('/user', [UserInfoController::class, 'userInfo'])->name('user.api');

    /**
     * Area routes
     */
    Route::apiResource('/areas', AreaController::class)->only('index','show');

});

/**
 * Authenticated and verified routes
 */
Route::middleware(['auth:sanctum','verified','profile'])->group(function () {

    /**
     * Group role check routes
     */
    Route::middleware('groupRoleCheck')->group(function () {
        Route::get('/items/search', [ItemSearchController::class, 'search']);
        Route::post('/items/download-selected', [ItemSearchController::class, 'downloadSelectedItems'])->name('download.select');
        Route::apiResource('/item-data', ItemDataController::class)->only(['index','show']);
        Route::apiResource('/items', ItemController::class)->only(['index','show','update']);
        Route::apiResource('/others', OtherController::class)->only(['index','show','update']);
    });

    /**
     * Group role check 1 routes
     */
    Route::middleware('groupRoleCheck1')->group(function () {
        Route::get('/export-items', [ExcelExportController::class, 'exportItems']);
        Route::apiResource('/users', UserController::class)->only(['index','show','update']);
        Route::apiResource('/item-data', ItemDataController::class)->only(['store','update']);
        Route::apiResource('/items-history', ItemHistoryController::class)->only(['index','show','store','update']);
        Route::apiResource('/items', ItemController::class)->only(['store']);
        Route::apiResource('/others', OtherController::class)->only(['store']);
        Route::apiResource('/repositories', RepositoryController::class)->only(['index','show']);
        Route::apiResource('/inventories', InventoryController::class)->only(['index','show']);
        Route::apiResource('/categories', CategoryController::class)->only(['index','show']);
        Route::apiResource('/manufacturers', ManufacturerController::class)->only(['index','show']);
        Route::apiResource('/suppliers', SupplierController::class)->only(['index','show']);
    });

    /**
     * Group role check 2 routes
     */
    Route::middleware('groupRoleCheck2')->group(function () {
        Route::apiResource('/users', UserController::class)->only(['store','destroy']);
        Route::apiResource('/item-data', ItemDataController::class)->only(['destroy']);
        Route::apiResource('/items', ItemController::class)->only(['destroy']);
        Route::apiResource('/others', OtherController::class)->only(['destroy']);
        Route::apiResource('/items-history', ItemHistoryController::class)->only(['destroy']);
        Route::apiResource('/repositories', RepositoryController::class)->only(['update']);
        Route::apiResource('/inventories', InventoryController::class)->only(['update']);
        Route::apiResource('/categories', CategoryController::class)->only(['store','update']);
        Route::apiResource('/manufacturers', ManufacturerController::class)->only(['store','update']);
        Route::apiResource('/suppliers', SupplierController::class)->only(['store','update']);
    });

    /**
     * Super admin routes
     */
    Route::middleware(['superAdmin'])->group(function () {
        Route::apiResource('/areas', AreaController::class)->only(['store','update','destroy']);
        Route::apiResource('/repositories', RepositoryController::class)->only(['store','destroy']);
        Route::apiResource('/inventories', InventoryController::class)->only(['store','destroy']);
        Route::apiResource('/categories', CategoryController::class)->only(['destroy']);
        Route::apiResource('/manufacturers', ManufacturerController::class)->only(['destroy']);
        Route::apiResource('/suppliers', SupplierController::class)->only(['destroy']);
    });

});
