<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\OrganizerController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');

Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Organizer
Route::get('sport', [SportController::class, 'index'])->name('sport');
Route::post('sport', [SportController::class, 'getData'])->name('sport-data');
Route::get('sport-create', [SportController::class, 'create'])->name('create-sport');
Route::post('sport-create', [SportController::class, 'store'])->name('store-sport');
Route::get('sport-edit/{id}', [SportController::class, 'edit'])->name('edit-sport');
Route::delete('sport-delete/{id}', [SportController::class, 'delete'])->name('delete-sport');

//
Route::get('organizer', [OrganizerController::class, 'index'])->name('organizer');
Route::post('/organizer', [OrganizerController::class, 'getData'])->name('organizer-data');
Route::get('/organizer-create', [SportController::class, 'create'])->name('create-organizer');

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

