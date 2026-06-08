<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\NotificationsController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Profile\ProfileController;
use App\Models\Product;
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
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::group(['prefix' => 'profile', 'as' => 'my-profile.', 'middleware' => ['auth', 'verified']], function () {

    Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('updatePersonalDetails', [ProfileController::class, 'updatePersonalDetails'])->name('update-personal-details');
    Route::put('updatePassword', [ProfileController::class, 'updatePassword'])->name('update-Password');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('notifications/read/{id}', [NotificationsController::class, 'read'])->name('notifications.read');
    Route::get('products/trash', [ProductsController::class, 'trash'])->name('products.trash');
    Route::put('products/restore/{slug}', [ProductsController::class, 'restore'])->name('products.restore');
    Route::delete('products/force-delete/{slug}', [ProductsController::class, 'forceDelete'])->name('products.force-delete');
    Route::get('search', [ProductsController::class, 'search'])->name('products.search');
    Route::resource('products', ProductsController::class);
});


require __DIR__ . '/auth.php';
