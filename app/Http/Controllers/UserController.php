<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('admin.users.users', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return view('admin.users.user',
            compact('user', 'roles')
        );
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect(route('admin.users.index'))->with('success', 'User updated');
    }
}
