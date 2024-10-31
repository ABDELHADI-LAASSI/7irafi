<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\WebController;
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
})->name('main')->middleware('user_and_guest');

Route::get('/dashboard', [App\Http\Controllers\Dashboard\dashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth' , 'role:admin'])->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('index',[App\Http\Controllers\Admin\AdminController::class, 'index'] )->name('index');
        });
    });
});


Route::middleware(['auth' , 'role:hirafi'])->group(function () {
    Route::name('hirafi.')->group(function () {
        Route::prefix('hirafi')->group(function () {
            Route::get('index',[App\Http\Controllers\Hirafi\HirafiController::class, 'index'] )->name('index');
        });
    });
});

Route::middleware(['auth' , 'role:user'])->group(function () {
    Route::name('user.')->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('index',[App\Http\Controllers\User\UserController::class, 'index'] )->name('index');
        });
    });
});


Route::prefix('/')->group(function () {
    Route::get('', function () { return view('welcome'); });
    Route::get('all' , [WebController::class , 'index']);
});






require __DIR__.'/auth.php';
