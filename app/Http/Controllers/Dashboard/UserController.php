<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\CRUDInterface;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller implements CRUDInterface
{
    public function create(Request $request)
    {
        $this->validation($request);

        $user = User::create($request->all());

        return response()->json($user);
    }

    public function render()
    {
        $users = User::paginate(10);

        $roles = Roles::get();

        return response()->json([
            'items' => $users,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if ($request->has('email') && $request->email != $user->email) {
            $this->validate($request, [
                'email' => 'email|unique:users,email',
            ]);
        }
        if ($request->has('phone') && $request->phone != $user->phone) {
            $this->validate($request, [
                'phone' => 'unique:users,phone',
            ]);
        }

        if (!empty($request->get('password'))) {
            $user->update($request->all());
        } else {
            $user->update($request->except('password'));
        }
    }

    public function delete($id)
    {
        $user = User::Find($id);

        $user->delete();
    }

    public function Validation(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
                'phone' => 'required|unique:users,phone|regex:/(^[0-9]{10}$)/u',
                'email' => 'email|unique:users,email',
                'password' => 'required|min:3',
                'role_id' => 'required|integer'
            ],
            [
                'phone.regex' => 'Ошибка ввода номера телефона',
            ]
        );
    }

    public function ExportExcel(Request $request)
    {

    }
}
