<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Telegram\Bot\Laravel\Facades\Telegram;

class VerificatedTask extends Model
{
    protected $guarded = [];

    public static function createTask(User $user)
    {
        $send_task = self::create([
            'user_id' => $user->id,
            'key' => random_int(100, 999) . '-' . random_int(100, 999),
        ]);

        return Telegram::sendMessage([
            'chat_id' => $user->telegram_id,
            'text' => $send_task->key . ' - код для входа в аккаунт'
        ]);
    }

    public function setExecuted() {
        $this->status = 'EXECUTED';
        $this->save();
    }
}
