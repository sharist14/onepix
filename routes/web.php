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

use App\Http\Controllers\Client;
Route::prefix('onepix.local')->group(function() {
    Route::get('/', [Client\IndexController::class, 'index']);

    Route::match(['get', 'post'],'/buildings/', [Client\BuildingController::class, 'index'])->name('client.building.index');
    Route::get('/buildings/{item}', [Client\BuildingController::class, 'show'])->name('client.building.show');
});
