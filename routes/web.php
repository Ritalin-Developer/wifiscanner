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
    // $responseData = Telegram::getUpdates();
    // $responseData = json_encode($responseData);
    // $responseData = json_decode($responseData, true);
    // $filteredData = [];
    // foreach ($responseData as $res) {
    //     if (isset($res['message']['entities']) && $res['message']['entities'][0]['type'] == 'bot_command') {
    //         array_push($filteredData, $res);
    //     }
    // }
    // foreach ($filteredData as $data) {
    //     Telegram::sendMessage([
    //         'chat_id' => $data['message']['chat']['id'],
    //         'text' => 'saya ganteng'
    //     ]);
    // }
        Telegram::sendMessage([
            // 'chat_id' => $data['message']['chat']['id'],
            'chat_id' => '-1001741565449',
            'text' => 'saya ganteng'
        ]);
    return 'ok';
});

// Standalone
// $update = $telegram->commandsHandler(true);
