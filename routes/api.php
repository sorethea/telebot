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
Route::post('bot/send', function (int $chatId, string $text){
    $response = \Telegram\Bot\Laravel\Facades\Telegram::sendMessage([
        "chat_id"=>$chatId,
        "text"=>$text,
    ]);
    return $response->getMessageId();
});

Route::post('bot/webhook', function (){
    return Telegram::setWebhook(['url' => 'https://pos.hieatapps.com/api/{token}/webhook']);
});

Route::post('/{token}/webhook', function () {
    $update = Telegram::commandsHandler(true);
    $chat = $update->getChat();
    $message = new \App\Models\Message();
    $message->save([
        "chat_id"=>$update->getChatId(),
        "message"=>$update->getMessage(),
        "chat"=>$chat,
        "response"=>json_encode($update),
    ]);
    // Commands handler method returns the Update object.
    // So you can further process $update object
    // to however you want.

    return 'ok';
});
