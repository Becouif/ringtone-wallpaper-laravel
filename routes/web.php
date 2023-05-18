<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RingtoneController;
use App\Http\Controllers\Backend\CategoryController;

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
    return view('welcome');
});

Auth::routes([
    'register'=>false
]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(array('namespace'=>'Backend',), function(){
    Route::get('/ringtone',[RingtoneController::class, 'index'])->name('ringtone.index');
    Route::get('/ringtone/create',[RingtoneController::class, 'create'])->name('ringtone.create');
    Route::post('/ringtone/store',[RingtoneController::class, 'store'])->name('ringtone.store');
    Route::get('/edit/{id}',[RingtoneController::class, 'edit'])->name('ringtone.edit');
    Route::put('/update/{id}',[RingtoneController::class, 'update'])->name('ringtone.update');
    Route::delete('/remove/ringtone/{id}',[RingtoneController::class, 'destroy'])->name('ringtone.destroy');
    // start of category routes 
    Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store',[CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}/remove',[CategoryController::class, 'destroy'])->name('category.destroy');
});




