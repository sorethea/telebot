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
                    [['text'=>'Check In', "request_location"=>true,'border'=>true]]
                ]
            ])
        ]);
    }
}
