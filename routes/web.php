<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\ReserveSpaceController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Guest\SpacePriceController;
use App\Http\Controllers\Guest\UserPlanController;

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

Route::get('/plan', [UserPlanController::class, 'index'])->name('plan');
Route::get('/show/{id}', [UserPlanController::class, 'show'])->name('show');

Route::get('/admin_contact', [AdminContactController::class, 'admin_contact'])->middleware(['auth'])->name('admin_contact');
Route::post('/admin_contact_update/{id}', [AdminContactController::class, 'admin_contact_update'])->middleware(['auth'])->name('admin_contact_update');
Route::get('/admin_contact_detail/{id}', [AdminContactController::class, 'admin_contact_detail'])->middleware(['auth'])->name('admin_contact_detail');

Route::get('/admin_reserve_space_create', [ReserveSpaceController::class, 'admin_reserve_space_create'])->middleware(['auth'])->name('admin_reserve_space_create');
Route::post('/admin_reserve_space_store', [ReserveSpaceController::class, 'admin_reserve_space_store'])->middleware(['auth'])->name('admin_reserve_space_store');
Route::get('/admin_reserve_space_index', [ReserveSpaceController::class, 'admin_reserve_space_index'])->middleware(['auth'])->name('admin_reserve_space_index');
Route::get('/admin_reserve_space_edit/{id}', [ReserveSpaceController::class, 'admin_reserve_space_edit'])->middleware(['auth'])->name('admin_reserve_space_edit');
Route::post('/admin_reserve_space_update/{id}', [ReserveSpaceController::class, 'admin_reserve_space_update'])->middleware(['auth'])->name('admin_reserve_space_update');
Route::post('/admin_reserve_space_destroy/{id}', [ReserveSpaceController::class, 'admin_reserve_space_destroy'])->middleware(['auth'])->name('admin_reserve_space_destroy');

Route::get('/admin_plan_index', [PlanController::class, 'admin_plan_index'])->middleware(['auth'])->name('admin_plan_index');
Route::get('/admin_plan_create', [PlanController::class, 'admin_plan_create'])->middleware(['auth'])->name('admin_plan_create');
Route::post('/admin_plan_store', [PlanController::class, 'admin_plan_store'])->middleware(['auth'])->name('admin_plan_store');

Route::get('/admin_space_price_create', [PlanController::class, 'admin_space_price_create'])->middleware(['auth'])->name('admin_space_price_create');
Route::post('/admin_space_price_store', [PlanController::class, 'admin_space_price_store'])->middleware(['auth'])->name('admin_space_price_store');
Route::get('/admin_space_price_edit/{id}', [PlanController::class, 'admin_space_price_edit'])->middleware(['auth'])->name('admin_space_price_edit');
Route::post('/admin_space_price_update/{id}', [PlanController::class, 'admin_space_price_update'])->middleware(['auth'])->name('admin_space_price_update');

Route::get('/admin_plan_edit/{id}', [PlanController::class, 'admin_plan_edit'])->middleware(['auth'])->name('admin_plan_edit');
Route::post('/admin_plan_update/{id}', [PlanController::class, 'admin_plan_update'])->middleware(['auth'])->name('admin_plan_update');
Route::post('/admin_plan_destroy/{id}', [PlanController::class, 'admin_plan_destroy'])->middleware(['auth'])->name('admin_plan_destroy');

Route::get('/get-space-prices', [SpacePriceController::class, 'getSpacePrices']);


Route::delete('/images/{id}', [ImageController::class, 'destroy']);
require __DIR__.'/auth.php';
