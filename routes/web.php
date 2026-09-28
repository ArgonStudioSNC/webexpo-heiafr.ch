<?php

use App\Http\Controllers\Web;
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

Route::namespace('Web')->group(function () {
    Route::redirect('/', '/2026/bachelor', 301);

    Route::get('/{year}', function ($year) {
        return redirect("/{$year}/bachelor", 301);
    })->where('year', '20[0-9]{2}');

    Route::get('/{vueroute?}', [Web\ApplicationController::class, 'index'])->where('vueroute', '^(?!api).*$')->name('app.index');
});
