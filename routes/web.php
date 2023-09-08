<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ListingController;

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

// Create New Status
Route::post('/listings/show', [StatusController::class, 'store'])->name('status.store');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/',[AdminController::class, 'index'])->name('admin.listings.index');
    // Route::get('listings/manage', [ListingController::class, 'manage'])->name('admin.listings.manage');
// Store Listing Data
// Route::post('listings/create', [ListingController::class, 'store'])->name('admin.listings.store');


//    GROUP LISTING ROUTE
         Route::prefix('listings')->group(function() {
             // Store Listing Data
             Route::post('/create', [ListingController::class, 'store'])->name('admin.listings.store');
            // Show Create Form
            Route::get('/create', [ListingController::class, 'create']);
            // Manage Listings
             Route::get('/manage', [ListingController::class, 'manage'])->name('admin.listings.manage');
            
            // Single Listing
             Route::get('/{listing}', [ListingController::class, 'show']);      
            // Show Edit Form
             Route::get('/{listing}/edit', [ListingController::class, 'edit']);
            // Update Listing
             Route::put('/{listing}', [ListingController::class, 'update']);
            // Delete Listing
            Route::delete('{listing}', [ListingController::class, 'destroy'])->name('admin.listings.destroy');
     });

//    GROUP AUTH ROUTE

         Route::prefix('/auth')->group(function() {
            // Show Register user form
            Route::get('/register', [AdminController::class, 'create'])->name('admin.auth.register');
            // Create New User
            Route::post('/register', [AdminController::class, 'store']);
            // Delete User
            Route::delete('{user}', [AdminController::class, 'destroy'])->name('admin.auth.destroy');
            // MANAGE USERS
            Route::get('/manage', [UserController::class, 'manage'])->name('admin.auth.manage');
            // Single User
            Route::get('/{user}', [UserController::class, 'show']);
            // Show Edit Form
            Route::get('/{user}/edit', [UserController::class, 'edit']);
            // Update user
            Route::put('/{user}', [UserController::class, 'update']);

         });
    
  
    Route::get('test',function(){
        return "Test";
    });
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
