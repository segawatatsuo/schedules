<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use Illuminate\Console\Scheduling\Schedule;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home', function () {
    return view('adminlte');
});

//発注登録
Route::get('create', [ScheduleController::class,'create'])->name('create');
Route::post('create', [ScheduleController::class, 'create'])->name('create');

//一覧
Route::get('list_display',[ScheduleController::class,'list_display'])->name('list_display');
Route::post('list_display',[ScheduleController::class,'list_display'])->name('list_display');

Route::get('show/{id}', [ScheduleController::class, 'show'])->name('show');
//Route::post('show/{$id}', [ScheduleController::class, 'show'])->name('show');



Route::get('create.destroy/{$id}', [ScheduleController::class, 'destroy'])->name('create.destroy');


//出荷
Route::get('shipping',[ScheduleController::class,'shipping'])->name('shipping');
Route::get('shipping_show/{id}',[ScheduleController::class,'shipping_show'])->name('shipping.show');

Route::get('processed',[ScheduleController::class,'processed'])->name('processed');
Route::get('processed_show/{id}',[ScheduleController::class,'processed_show'])->name('processed.show');


Route::get('user',[ScheduleController::class,'user'])->name('user');

Route::get('store',[ScheduleController::class,'store'])->name('store');
Route::post('store',[ScheduleController::class,'store'])->name('store');

Route::get('generate_pdf',[ScheduleController::class,'generate_pdf'])->name('generate_pdf');

Route::get('update',[ScheduleController::class,'update'])->name('update');
Route::post('update',[ScheduleController::class,'update'])->name('update');
