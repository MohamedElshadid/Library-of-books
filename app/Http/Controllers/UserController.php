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


    public function showUser(){
        
        $users = User::whereIn('is_admin', [0])->get();
        
        return view('users.showUser',['users'=>$users]);
        
    }
    public function showAdmin(){
        
        $users = User::whereIn('is_admin', [1])->where('id', '!=', Auth::id())->get();
        
        return view('users.showAdmin',['users'=>$users]);
        
    }

    public function makeAdmin(User $users){
        $id = $users->id;
        $user=User::find($id);
        if($user){
            $user->is_admin = 1 ;
            $user->save();
        }
        return redirect()->route('admins.showAdmin');

    }
    public function removeAdmin(User $users){
        $id = $users->id;
        $user=User::find($id);
        if($user){
            $user->is_admin = 0 ;
            $user->save();
        }
        return redirect()->route('admins.showAdmin');

    }
    public function deactivate(User $users){
        $id = $users->id;
        $user=User::find($id);
        if($user){
            $user->active = 0 ;
            $user->save();
        }
        return redirect()->route('users.showUser');
    }
    public function activate(User $users){
        $id = $users->id;
        $user=User::find($id);
        if($user){
            $user->active = 1 ;
            $user->save();
        }
        return redirect()->route('users.showUser');
    }


}
