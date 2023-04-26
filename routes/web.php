<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyFirstController;
use App\Models\MyFirstModel;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;

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

Route::get('get-all-students', [MyFirstController::class, 'getAllStudents']);
Route::delete('delete-selected-students', [MyFirstController::class, 'deleteSelectedStudents']);
Route::resource('crud', MyFirstController::class);

// Route::controller(MyFirstController::class)->group(function(){
//     Route::get('home', 'index');
//     Route::get('create', 'create');
//     Route::get('edit', 'edit');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
