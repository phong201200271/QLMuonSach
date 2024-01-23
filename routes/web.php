<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
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

//User
    //GET
Route::get('/login',function () {
    return view('login');
})->name('login');

Route::get('/403', function () {
    return view('error.403');
})->name('403');

Route::middleware(['auth'])->group(function () {
    // GET
    Route::get('/', [BookController::class,'getBookForHomePage'])->name('home');

    Route::get('/test',function () {
        return view('test');
    });

    Route::get('/book/{id}',[BookController::class,'getDetailBook'])->name('detail_book');

    Route::get('/book/category/{categoryId}',[BookController::class,'getBookByCategory'])->name('getBookByCategory');
});

    //POST
Route::post('/login')->middleware('auth.user')->name('login');

Route::post('/logout',[UserController::class,'logout'])->name('logout');

//Admin
Route::prefix('admin')->group(function () {
    //GET
    Route::get('/login',function () {
        return view('admin.login');
    })->name('admin.login');

    //POST
    Route::post('/login')->middleware('auth.admin')->name('admin.login');

    Route::post('/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::middleware('auth.check.admin')->group(function () {
        //GET
        Route::get('/dashboard',function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/manage/book',[BookController::class,'getBookForManageBookPage'])->name('manageBook');

        Route::get('/edit/book/{bookId}',[BookController::class,'getBookEdit'])->name('editBookPage');

        Route::get('/add/book',[BookController::class,'addBookPage'])->name('addBookPage');
        //POST

        //PUT


    });
});


