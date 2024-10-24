<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BluRayController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainpageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ProductController;



Route::get('/', function () {
    return view('all');
});
Route::get('/bluraydetail', function () {
    return view('bluraydetail');
});
Route::post('/rent-bluray', [RentController::class, 'rent'])->name('rent.bluray');
Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest'); 

Route::get('/dashboard', function () {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admindashboard');
    } elseif (Auth::user()->role == 'member') {
        return redirect()->route('memberdashboard');
    } else {
        return abort(403, 'Unauthorized action.');
    }
})->name('dashboard')->middleware('auth');
Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admindashboard')->middleware('auth');
Route::get('/memberdashboard', [MemberDashboardController::class, 'index'])->name('memberdashboard')->middleware('auth');

Route::get('bluray.create', [BluRayController::class, 'create'])->name('blurays.create')->middleware('admin');
Route::post('blurays', [BluRayController::class, 'store'])->name('blurays.store')->middleware('admin');
Route::get('blurays/{id}/edit', [BluRayController::class, 'edit'])->name('blurays.edit');
Route::put('blurays/{id}', [BluRayController::class, 'update'])->name('blurays.update');
Route::delete('blurays/{id}', [BluRayController::class, 'destroy'])->name('blurays.destroy');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::get('/bluray/{id}', [BluRayController::class, 'show'])->name('bluray.detail');
Route::get('/search-title', [BlurayController::class, 'searchByTitle'])->name('bluray.search.title');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


Route::get('/mainpage', [MainpageController::class, 'index'])->name('mainpage')->middleware('auth');

Route::post('/rental/{id}/request-return', [RentalController::class, 'requestReturn'])->name('rental.requestReturn');
Route::post('/rental/{id}/approve-return', [RentalController::class, 'approveReturn'])->name('rental.approveReturn');

Route::post('/rental/check-fine', [RentalController::class, 'checkAndCalculateFine'])->name('checkFine');

Route::get('/category/{categoryName}', [ProductController::class, 'showCategory'])->name('category.show');


require __DIR__.'/auth.php';
