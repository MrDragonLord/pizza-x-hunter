<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->middleware('guest')->except('logout');
    }

    public function Login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse();
        }

        return $this->sendFailedLoginResponse();
    }

    protected function sendLoginResponse()
    {
        $token = (string) $this->guard()->getToken();

        return Response::json([
            'token' => $token
        ]);
    }


    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Не введён Email',
                'password.required' => 'Не введён пароль пользователя',
            ]
        );
    }

    protected function attemptLogin(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (!$token) {
            return false;
        }

        $this->guard()->setToken($token);

        return true;
    }

    public function user(Request $request)
    {
        return Response::json($request->user());
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
    }
}
