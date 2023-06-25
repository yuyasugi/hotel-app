<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Admin\AdminContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/top', function () {
    return view('guest.top');
})->name('top');

Route::get('/access', function () {
    return view('guest.access');
})->name('access');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact_confirm');
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact_store');
Route::get('/thanks', [ContactController::class, 'store']);

Route::get('/admin_contact', [AdminContactController::class, 'admin_contact'])->middleware(['auth'])->name('admin_contact');
Route::post('/admin_contact_update/{id}', [AdminContactController::class, 'admin_contact_update'])->middleware(['auth'])->name('admin_contact_update');
Route::get('/admin_contact_detail/{id}', [AdminContactController::class, 'admin_contact_detail'])->middleware(['auth'])->name('admin_contact_detail');

require __DIR__.'/auth.php';
