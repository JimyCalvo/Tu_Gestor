<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WelcomeController;
// use App\Http\Controllers\Api\Auth\LogoutController;
// use App\Http\Controllers\Api\Auth\LoginController;
// use App\Http\Controllers\Web\
// {
//     ProfileController,
//     UserController,
//     AreaController,
//     RepositoryController,
//     InventoryController,
//     CategoryController,
//     ManufacturerController,
//     SearchController,
//     SupplierController,
//     ItemDataController,
//     ItemController,
//     OtherController,
//     InventoryEntryController,
//     InventoryExitController,
//     ItemHistoryController,

// };




Route::get('/', [WelcomeController::class, 'show'])->name('welcome');


// // Route::get('/', function () {
// //     return view('blanco');
// // })->name('welcome');
// Route::view('h', 'blanco')->name('blanco');


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth2.login')->name('login');
    Route::view('/register', 'auth2.register')->name('register');
    Route::view('/password/reset', 'auth2.passwords.email')->name('password.request');

});

// Route::middleware(['auth'])->get('profile/create', function () {
//     return view('profile.create');
// })->name('profile.create');


// Route::middleware(['auth', 'ensureProfile',])->group(function () {

//     Route::middleware('empleado')->group(function () {
//         Route::view('home', 'home.home_1')->name('home');
//         Route::view('dashboard', 'dashboard')->name('dashboard');

//     });
// });

// Route::middleware(['auth', 'ensureProfile',])->group(function () {
//     Route::prefix('supervisor')->middleware('supervisor')->group(function () {
//         Route::view('home', 'home.home_2')->name('home');
//         Route::view('dashboard', 'dashboard')->name('dashboard');

//     });
// });

// Route::middleware(['auth', 'ensureProfile',])->group(function () {

//     Route::prefix('admin')->middleware('administrador')->group(function () {
//         Route::view('home', 'home.home_3')->name('home');
//         Route::view('dashboard', 'dashboard')->name('dashboard');

//     });

// });

// Route::middleware(['auth', 'ensureProfile',])->group(function () {
//     Route::prefix('super-admin')->middleware('superadministrador')->group(function () {
//         Route::view('home', 'home.home_4')->name('home');
//         Route::view('dashboard', 'dashboard')->name('dashboard');

//     });
// });






// Ruta para mostrar la lista de áreas
// Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
// Route::get('/areas/create', [AreaController::class, 'create'])->name('areas.create');
// Route::get('/areas/{area}/edit', [AreaController::class, 'edit'])->name('areas.edit');


// Route::delete('/areas/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');


