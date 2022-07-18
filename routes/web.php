<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WifiScannerController;
use Illuminate\Http\Request;
use Telegram as Telegram;

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

Route::get('/bot/getupdates', function() {
    $updates = Telegram::getUpdates();
    return (json_encode($updates));
});

Route::prefix('wifiscanner')->group(function () {
    Route::get('/', [App\Http\Controllers\WifiScannerController::class, 'index'])->name('index');
});

// Laravel
Route::post('/5465295406:AAH_GzsIj6xd2IPukMhK-c1GJzpQQpCWHm0/webhook', function (Request $request) {

    return dd($request->getContent());
});

// Standalone
// $update = $telegram->commandsHandler(true);
