<?php

namespace App\Telegram\Commands;



use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    protected string $name = 'start';

    protected string $description = 'Start command for telegram bot.';

    public function handle(): void
    {
        $keyboard = [
            [
                ['text' => 'Button 1', 'callback_data' => 'button1'],
                ['text' => 'Button 2', 'callback_data' => 'button2'],
            ],
        ];
        $this->replyWithMessage([
            'text' => 'Hey, there! Welcome to our bot!',
            [
                ['reply_markup' => ['inline_keyboard' => $keyboard]]
            ]
        ]);
    }
}
