<?php

use App\Models\User;
use App\Models\Medicine;
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

Route::get('/', function () {
    $medicines = Medicine::all();
    $user = User::where('role' , 'Pharmacist')->get();
    return view('welcome' , compact('medicines' , 'user'));
});
Route::get('/details/{id}', [App\Http\Controllers\Controller::class, 'show_details'])->name('details');
Route::get('search', [App\Http\Controllers\Controller::class, 'search'])->name('search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  Route::group(['prefix'=>'pharmacist', 'middleware' =>['auth'  ] ] , function()
  {
    Route::get('/medicines', [App\Http\Controllers\HomeController::class, 'show_medicines'])->name('medicines');
    Route::delete('/medicines/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete_medicines'])->name('delete.medicines');
    Route::get('/add/medicines', [App\Http\Controllers\HomeController::class, 'add_medicines'])->name('add.medicines');
    Route::post('/add/medicines', [App\Http\Controllers\HomeController::class, 'store_medicines'])->name('store.medicines');
    Route::get('/edit/medicines/{id}', [App\Http\Controllers\HomeController::class, 'edit_medicines'])->name('edit.medicines');
    Route::put('/edit/medicines', [App\Http\Controllers\HomeController::class, 'update_medicines'])->name('update.medicines');
    Route::get('/notifications/mark-as-read/{id}', [App\Http\Controllers\HomeController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/demand', [App\Http\Controllers\HomeController::class, 'store_demand_amount'])->name('store.demand.amount');
    Route::get('/show/demand', [App\Http\Controllers\HomeController::class, 'browse_demand'])->name('browse.demand');

  });
  
  Route::group(['prefix'=>'repository', 'middleware' =>['auth'  ] ] , function()
  {
    Route::get('/demand', [App\Http\Controllers\HomeController::class, 'show_demand'])->name('show.demand');
    Route::get('/demand/reject/{id}', [App\Http\Controllers\HomeController::class, 'reject_demand'])->name('reject.demand');
    Route::post('/demand/accept/{id}', [App\Http\Controllers\HomeController::class, 'accept_demand'])->name('accept.demand');
  });

    
  Route::group(['prefix'=>'patient', 'middleware' =>['auth'  ] ] , function()
  {
    Route::post('/demand', [App\Http\Controllers\HomeController::class, 'send_demand'])->name('demand.patient');
    Route::get('/demand', [App\Http\Controllers\HomeController::class, 'my_demand'])->name('my.demand');

  });
  
  