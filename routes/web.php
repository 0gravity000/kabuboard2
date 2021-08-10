<?php

use App\Http\Controllers\StockController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard-notlogin', [StockController::class, 'index'])->name('dashboard-notlogin');
/*
Route::get('/dashboard-notlogin', function () {
    return view('dashboard-notlogin');
})->name('dashboard-notlogin');
*/

require __DIR__.'/auth.php';
