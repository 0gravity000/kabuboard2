<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\DailyPriceController;

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\CrapIndex;

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

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
 */
Route::get('/dashboard', [StockController::class, 'index'])->name('dashboard');
Route::get('/dailyprice', [DailyPriceController::class, 'index'])->name('dailyprice');

require __DIR__.'/auth.php';
