<?php

use App\Http\Controllers\Admin\PhotoController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
  Route::get('form-fotos', [PhotoController::class, 'index'])->name('photo-form');
  Route::get('form-fotos-update/{id}', [PhotoController::class, 'edit'])->name('edit-form-foto');
});
