<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\FrontController;
use App\Models\Mobil;
use App\Models\Car;
use App\Models\Buyer;
use App\Models\Bank;
use App\Models\Permission;

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

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::get('mobil', [FrontController::class, 'mobil'])->name('front.mobil');
Route::get('mobil-detail/{id}', [FrontController::class, 'mobil_detail'])->name('front.mobil.detail');

Auth::routes();

//===========================================================================
//===========================================================================
//===========================================================================

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

  //Dashboard
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::group(['middleware' => ['role:superadmin|sales']], function() {    
  
    //Profile
    Route::get('profile-superadmin', \App\Http\Livewire\ProfileTeacher::class)->name('profile.superadmin');
    Route::get('profile-teacher', \App\Http\Livewire\ProfileTeacher::class)->name('profile.teacher');
    
    //car
    Route::get('car', \App\Http\Livewire\DataCars::class)->name('car');
    Route::get('getmobil', \App\Http\Livewire\DataMobil::class)->name('mobil');
    Route::resource('mobils', MobilController::class);

    //bank
    Route::get('bank', \App\Http\Livewire\DataBank::class)->name('bank');

    //harga
    Route::get('harga/{id}', \App\Http\Livewire\DataHarga::class)->name('harga');
    
    //buyer
    Route::get('buyer', \App\Http\Livewire\DataBuyers::class)->name('buyer');
    
    //order
    Route::get('order', \App\Http\Livewire\DataOrders::class)->name('order');
    Route::get('beli', \App\Http\Livewire\DataBeli::class)->name('beli');

    //credit
    Route::get('credit/{id}', \App\Http\Livewire\DataCredits::class)->name('credit');
    Route::get('kredit/{id}', \App\Http\Livewire\DataKredit::class)->name('kredit');
  });

  //Profile Student
  Route::get('profile-student', \App\Http\Livewire\ProfileStudent::class)->name('profile.student');


});

//===========================================================================
//===========================================================================
//===========================================================================

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function() {
    return redirect()->route('dashboard');
});

Route::get('/password/email', function() {
    return redirect()->route('dashboard');
});

Route::get('/password/reset', function() {
    return redirect()->route('dashboard');
});
Route::get('/register', function() {
    return redirect()->route('dashboard');
});
