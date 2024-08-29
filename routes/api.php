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
Route::post('/<token>/webhook', function () {
    $update = Telegram::commandsHandler(true);

    // Commands handler method returns the Update object.
    // So you can further process $update object
    // to however you want.

    return 'ok';
});
