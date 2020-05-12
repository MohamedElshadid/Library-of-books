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
            'username' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            // 'image' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        // $imageName = time() . '.' . $user['image']->getClientOriginalExtension();

        // $user['image']->move(
        // base_path() . '/public/upload/', $imageName);

        $user->username = request('username');
        $user->email = request('email');
        // $user->image = $imageName;
        $user->password = bcrypt(request('password'));

        $user->save();

        return redirect()->route('home')->with('success', 'Profile has been updated successfully..');;
    }
}
