<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;


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


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/',[AdminController::class, 'index'])->name('admin.listings.index');
    // Show Create Form
     Route::get('/listings/create', [ListingController::class, 'create']);
    // Store Listing Data
     Route::post('/listings', [ListingController::class, 'store']);


    // Manage Listings
    Route::get('/listings/manage', [ListingController::class, 'manage'])->name('admin.listings.manage');
    // Show Edit Form
     Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    // Update Listing
     Route::put('/listings/{listing}', [ListingController::class, 'update']);

    // Delete Listing
     Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);


    // MANAGE USERS
    Route::get('/auth/manage', [UserController::class, 'manage'])->name('admin.auth.manage');
    // Show Edit Form
    Route::get('/auth/{user}/edit', [UserController::class, 'edit']);
    // Update user
    Route::put('/auth/{listing}', [UserController::class, 'update']);
});


// All Listings
Route::get('/', [ListingController::class, 'index']);

// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);


// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create New User
Route::post('/auth', [UserController::class, 'store']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/auth/authenticate', [UserController::class, 'authenticate']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');


// require __DIR__.'/auth.php';
