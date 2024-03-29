<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tests', [App\Http\Controllers\HomeController::class, 'tests'])->name('tests');
Route::get('/test/{id}', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::post('/test/{id}', [App\Http\Controllers\HomeController::class, 'test'])->name('test');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/admin/tests', [App\Http\Controllers\Admin\AdminTestController::class, 'view_tests'])->name('view_tests');
Route::get('/admin/test/{id}', [App\Http\Controllers\Admin\AdminTestController::class, 'test'])->name('test');
Route::get('/admin/add_test', [App\Http\Controllers\Admin\AdminTestController::class, 'add_test'])->name('add_test');
Route::post('/admin/add_test', [App\Http\Controllers\Admin\AdminTestController::class, 'add_test'])->name('add_test');
Route::get('/admin/change_test/{id}', [App\Http\Controllers\Admin\AdminTestController::class, 'change_test'])->name('change_test');
Route::post('/admin/change_test/{id}', [App\Http\Controllers\Admin\AdminTestController::class, 'change_test'])->name('change_test');
Route::get('/admin/delete_test/{id}', [App\Http\Controllers\Admin\AdminTestController::class, 'delete_test'])->name('delete_test');

require __DIR__.'/auth.php';
