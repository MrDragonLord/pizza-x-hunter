<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Commands\Command;
use Telegram;

/**
 * Class PhoneNumberCommand.
 */
class PhoneNumberCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'phone';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['phonenumber', 'start'];

    /**
     * @var string Command Description
     */
    protected $description = 'Get phone number.';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $response = $this->getUpdate();
        $chat_id = $response->getChat()->getId();

        $btn = Keyboard::button([
            'text' => 'Поделиться контактом',
            'request_contact' => true,
        ]);

        $keyboard = Keyboard::make([
            'keyboard' => [[$btn]],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        return $this->replyWithMessage([
            'text' => 'Для оформления заказа необходимо поделиться с нами вашим контактным номером телефона. Для этого нажмите на кнопку ниже',
            'reply_markup' => $keyboard
        ]);
    }
}
