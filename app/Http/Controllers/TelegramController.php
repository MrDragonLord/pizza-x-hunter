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
        if (isset($updates['message']['contact'])) {
            $user_phone = $updates['message']['contact']['phone_number'];
            if ($user_phone) {
                $user_phone = substr($user_phone, 2);

                $user = $this->setUserVerify($user_phone, $chat_id);
                if (isset($user)) {
                    $text = 'Подтверждено успешно, ждём Вас в приложении!';
                    Telegram::sendMessage(['chat_id' => $chat_id, 'text' => $text]);
                    return VerificatedTask::createTask($user);
                }
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
            $user->phoneVerifiedAt();
            $user->telegram_id = $chatId;
            $user->save();
            return $user;
        }
        return false;
    }
}
