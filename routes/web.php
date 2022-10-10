<?php

use App\Http\Controllers\TestController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [TestController::class, 'index'])->name('home');
Route::post('/detail', [TestController::class, 'detail'])->name('detail');
Route::post('/update', [TestController::class, 'update'])->name('update');
Route::post('/table', [TestController::class, 'table'])->name('table');
Route::post('/select-companies', [TestController::class, 'selectCompany'])->name('filter_company');
Route::post('/select-teirs', [TestController::class, 'selectTiers'])->name('filter_tier');
Route::post('/select-segment', [TestController::class, 'selectSegment'])->name('filter_segment');
