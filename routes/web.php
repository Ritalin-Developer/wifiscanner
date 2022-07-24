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
    $data = '{"update_id":230189155,"message":{"message_id":93,"from":{"id":1024615671,"is_bot":false,"first_name":"Ricky","username":"Rickyfishboy","language_code":"en"},"chat":{"id":-1001741565449,"title":"Ritalin_wifi_scanner","type":"supergroup"},"date":1658127871,"text":"/help","entities":[{"offset":0,"length":5,"type":"bot_command"}]}}';
    $data = json_decode($data, true);
    return dd($data['message']['chat']['id'], $data['message']['text']);
});

Route::prefix('wifiscanner')->group(function () {
    Route::get('/', [App\Http\Controllers\WifiScannerController::class, 'index'])->name('index');
});

// Laravel
Route::post('/5465295406:AAH_GzsIj6xd2IPukMhK-c1GJzpQQpCWHm0/webhook', function (Request $request) {
    $response = json_decode($request->getContent(), true);
    if ($response['message']['text'] == '/start') {
        $response = Http::get('http://10.30.23.61/status');
        $wifiList = json_decode(str_replace("'", '"', $response->body()), true);

        $botChatText = "WiFi Status ";

        foreach ($wifiList as $key => $wifi) {
            $botChatText = $botChatText.($key + 1)."\n";
            $botChatText = $botChatText."SSID : ".$wifi["SSID"]."\n";
            $botChatText = $botChatText."RSSI : ".$wifi["RSSI"]."\n";
            $botChatText = $botChatText."MAC : ".$wifi["MAC"]."\n";
            $botChatText = $botChatText.$wifi["isSecured"]."\n\n";
        }

        $data = [
            'chat_id' => $response['message']['chat']['id'],
            'text' => $botChatText
        ];
    } else if ($response['message']['text'] == '/stop') {
        $data = [
            'chat_id' => $response['message']['chat']['id'],
            'text' => 'kita stop ya..'
        ];
    } else if ($response['message']['text'] == '/help') {
        $data = [
            'chat_id' => $response['message']['chat']['id'],
            'text' => 'kita bantu ya..'
        ];
    }

    Telegram::sendMessage($data);
    // Telegram::sendMessage([
    //     'chat_id' => '-1001741565449',
    //     'text' => $request->getContent(),
    // ]);
    return 'ok';
});

// Standalone
// $update = $telegram->commandsHandler(true);
