<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificatedTask;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function commandHandlerWebHook()
    {
        $updates = Telegram::commandsHandler(true);

        $chat_id = $updates->getChat()->getId();

        // Catch Phone Number
        $user_phone = array_key_exists('contact', $updates['message']) ?
            $updates['message']['contact']['phone_number'] : null;

        if ($user_phone) {
            if ($user = $this->setUserVerify($user_phone, $chat_id)) {

                $text = 'Подтверждено успешно, ждём Вас в приложении!';
                Telegram::sendMessage(['chat_id' => $chat_id, 'text' => $text]);

                return VerificatedTask::createTask($user);
            }
        }

        return 'ok';
    }

    public function setWebHook()
    {
        $url = env('APP_URL') . '/' . env('TELEGRAM_BOT_TOKEN') . '/webhook';
        $response = Telegram::setWebhook(['url' => $url]);

        return $response == true ? redirect()->back() : dd($response);
    }

    public function setUserVerify(string $phone, $chatId)
    {
        $user = User::where('phone', $phone)->first();
        if (isset($user)) {
            $phone = substr($phone, 1);

            $user->phoneVerifiedAt();
            $user->telegram_id = $chatId;
            return $user;
        }
        return false;
    }
}
