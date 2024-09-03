<?php

namespace App\Telegram\Commands;



use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{
    protected string $name = 'start';

    protected string $description = 'Start command for telegram bot.';

    public function handle(): void
    {
        $this->replyWithMessage([
            'text' => 'Hey, there! Welcome to our bot!',
            'reply_markup'=>json_encode([
                'keyboard'=>[
                    [['text'=>'Subscript', "request_contact"=>true,'border'=>true,'one_time_keyboard'=>true]],
                    [['text'=>'Check In', "request_location"=>true,'border'=>true]],
                ],
                'resize_keyboard' => true, // Optional
                'one_time_keyboard' => false, // Optional
                'selective_width' => false, // Optional
            ])
        ]);
    }
}
