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
        $user->roles()->sync($request->input('roles.*'));


        return redirect(
            route('admin.users.index')
        )->with('success', "User \"$user->id: $user->name\" updated");
    }

    public function create(Request $request)
    {
        return view('admin.users.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->roles()->sync($request->input('roles.*'));

        return redirect(route('admin.users.index'));
    }

    public function destroy(int $id)
    {
        if ($id === auth()->user()->id) {
            return redirect(
                route('admin.users.index')
            )->with('error', "You cannot delete yourself");
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect(
                route('admin.users.index')
            )->with('success', "User \"$user->id: $user->name\" deleted");
        }

        return redirect(
            route('admin.users.index')
        )->with('error', "User cannot be deleted");
    }
}
