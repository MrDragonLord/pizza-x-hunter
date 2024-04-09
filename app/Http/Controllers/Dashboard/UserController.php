<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\CRUDInterface;
use App\Models\Roles;

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
        $search = request()->get('search');

        if ($search) {
            $users = User::where('name', 'LIKE', "%{$search}%")->SimplePaginate(30);
        } else {
            $users = User::SimplePaginate(30);
        }

        $roles = Roles::get();

        return response()->json([
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
    }

    public function delete($id)
    {
        $user = User::Find($id);

        $user->delete();
    }

    public function Validation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'phone' => 'required|unique:users,phone',
            'email' => 'email|unique:users,email',
            'password' => 'required|min:3',
            'role_id' => 'required|integer|min:1'
        ]);
    }
}
