<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Telegram as Telegram;

class WifiScannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('http://192.168.129.215/status');
        $json = '[{"email":"john@doe.com"},{"email":"john@doe.com"}]';
        // return dd(substr_count($response->body(),","));
        // return dd(substr($response->body(),0, -2));
        // return dd();
        $wifiList = json_decode(str_replace("'", '"', $response->body()), true);

        $botChatText = "WiFi Status ";

        foreach ($wifiList as $key => $wifi) {
            // return dd($key);
            $botChatText = $botChatText.($key + 1)."\n";
            $botChatText = $botChatText."SSID : ".$wifi["SSID"]."\n";
            $botChatText = $botChatText."RSSI : ".$wifi["RSSI"]."\n";
            $botChatText = $botChatText."MAC : ".$wifi["MAC"]."\n";
            $botChatText = $botChatText.$wifi["isSecured"]."\n\n";
        }

        Telegram::sendMessage([
            'chat_id' => '-1001741565449',
            'text' => $botChatText
        ]);



        return 'ok';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
