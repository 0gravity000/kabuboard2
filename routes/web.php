<?php

use App\Http\Controllers\StockController;
use App\Http\Controllers\DailyPriceController;
use App\Http\Controllers\DailyVolumeController;

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
Route::get('/dashboard/show/markets/{id}', [StockController::class, 'show_markets'])->name('dashboard_markets');
Route::get('/dashboard/show/industries/{id}', [StockController::class, 'show_industries'])->name('dashboard_industries');

Route::get('/dailyprice', [DailyPriceController::class, 'index'])->name('dailyprice');
Route::get('/dailyvolume', [DailyVolumeController::class, 'index'])->name('dailyvolume');

Route::get('/debug', [DailyPriceController::class, 'debug'])->name('debug');

require __DIR__.'/auth.php';
