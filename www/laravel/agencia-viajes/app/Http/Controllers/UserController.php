<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'rol' => 'required|in:admin,user', 
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol = $request->rol;
            
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar usuario.');
        }
    }

    public function destroy(User $user)
    {
        try {
            if (auth()->id() == $user->id) {
                return back()->with('error', '¡No puedes borrarte a ti mismo!');
            }

            $user->delete();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar usuario.');
        }
    }
}