<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('bot/me', function (){
    return \Telegram\Bot\Laravel\Facades\Telegram::getMe();
});
Route::post('bot/updates', function (){
    return \Telegram\Bot\Laravel\Facades\Telegram::getUpdates();
});
Route::post('bot/send', function (){

    $response = \Telegram\Bot\Laravel\Facades\Telegram::sendMessage([
        "chat_id"=>\request()->get('chat_id'),
        "text"=>\request()->get('text'),
    ]);
    return $response->getMessageId();
});

Route::post('bot/webhook', function (){
    return Telegram::setWebhook(['url' => 'https://pos.hieatapps.com/api/{token}/webhook']);
});

Route::post('/{token}/webhook', function () {
    Telegram::commandsHandler(true);
    $update = Telegram::getWebhookUpdate();
    $chat = $update->getChat();
    $msg = $update->getMessage();
    $message = new \App\Models\Message();
    $message->chat_id = $chat->getId();
    $message->type = $chat->get("type");
    $message->title = $chat->get("title");
    $message->first_name = $chat->get('first_name');
    $message->last_name = $chat->get('last_name');
    $message->text = $msg->get('text');
    $message->message = $msg;
    $message->save();
    if($message->text == '/start'){
        Telegram::sendMessage([
            'chat_id'=>$chat->getId(),
            'text'=>'Hi, I am a bot!',
            'replay_markup'=>[
                'keyboard'=>[
                    ['text'=>'Check In', 'request_location'=>true]
                ]
            ]
        ]);
    }
    return 'ok';
});
