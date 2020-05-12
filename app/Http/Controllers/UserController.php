<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    { 
        $this->validate(request(), [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'image' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user->username = request('username');
        $user->email = request('email');
        $user->image = request('image');
        $user->password = bcrypt(request('password'));

        $user->save();

        return redirect()->route('home')->with('success', 'Profile has been updated successfully..');;
    }
}
