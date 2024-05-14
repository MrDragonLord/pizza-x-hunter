<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
                'phone' => 'required|string',
            ],
        );
    }

    protected function AuthUser(Request $request, User $user)
    {
        if ($user->userPhoneVerified) {
            throw ValidationException::withMessages([
                'phone' => 'Подтвердите номер телефона в Telegram!',
            ]);
        }
    }

    protected function createUser(Request $request)
    {
        User::create([
            'phone' => $request->get('phone')
        ]);
    }
}
