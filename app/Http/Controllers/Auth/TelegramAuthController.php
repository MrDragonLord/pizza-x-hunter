<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VerificatedTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class TelegramAuthController extends Controller
{
    public function Login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('phone', $request->get('phone'))->first();

        if (isset($user))
            return $this->AuthUser($request, $user);

        $this->createUser($request);

        return $this->sendFailedLoginResponse();
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                'phone' => 'required|string|regex:/^[0-9]{10}$/u',
                'code' => 'string|regex:/^[0-9]{3}-[0-9]{3}$/u',
            ],
            [
                'phone.regex' => 'Ошибка ввода номера телефона',
                'code.regex' => 'Ошибка ввода кода',
            ]
        );
    }

    protected function AuthUser(Request $request, User $user)
    {
        if (!$user->userPhoneVerified()) {
            throw ValidationException::withMessages([
                'phone' => 'Подтвердите номер телефона в Telegram!',
            ]);
        }

        $code = $request->get('code');

        if (!isset($code)) {
            VerificatedTask::createTask($user);
            throw ValidationException::withMessages([
                'code' => 'Отправлен код подтверждения!',
            ]);
        }

        $verify = VerificatedTask::where([
            'key' => $code,
            'status' => 'WAITING'
        ])->first();

        if (isset($verify)) {
            $token = auth()->login($user);

            $verify->setExecuted();

            return $this->sendLoginResponse($token);
        }
        throw ValidationException::withMessages([
            'code' => 'Введите код подтверждения!',
        ]);
    }

    protected function sendLoginResponse($token)
    {
        return Response::json([
            'token' => $token
        ]);
    }

    protected function createUser(Request $request)
    {
        return User::create([
            'phone' => $request->get('phone'),
            'role_id' => 0
        ]);
    }

    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            'phone' => [trans('auth.failed')],
        ]);
    }
}
