<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::post('/chck-serial', [SerialController::class,'check'])->name('chck-serial');

// Route::resource('users', UserController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

// Route::post('/change', UserController::class, 'change');
Route::post('/change', [UserController::class,'change'])->name('change');
Route::get('/change', [UserController::class,'changep'])->name('change');

Route::middleware(['auth'])->group(function () {
  Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/print', [SerialController::class,'print'])->name('print');
    Route::post('/download', [SerialController::class,'download'])->name('download');
    Route::post('/print', [SerialController::class,'printCode'])->name('print');
    Route::resource('serials', SerialController::class);
   
    Route::middleware(['checkrole:superadmin,admin'])->group(function(){
        Route::resource('users', UserController::class);
      });
    
      Route::middleware(['checkrole:superadmin'])->group(function(){
        Route::resource('roles', RoleController::class);
        Route::resource('serials', SerialController::class, ['only' => ['index','store']]);
        Route::get('/assign', [SerialController::class,'assign'])->name('assign');

      });
     

});