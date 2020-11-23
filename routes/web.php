<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerialController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [SerialController::class,'index'])->name('dashboard');

Route::post('/chck-serial', [SerialController::class,'check'])->name('chck-serial');
Route::resource('serials', SerialController::class);