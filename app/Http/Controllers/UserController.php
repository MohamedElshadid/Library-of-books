<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // =========================== Admin ==============================
    public function editAdmin(User $user)
    {   
        $user = Auth::user();
        return view('users.editAdmin', compact('user'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => ['string', 'max:255'],
            // 'image' => ['required'],
            'old_password' => ['required' , 'string', 'min:8'],
            'new_password' => ['string', 'min:8']
        ]);

        // if($request->hasFile('image')) {
        //     $image_name = $request->file('image')->getClientOriginalName();              
        //     $image_path = $request->file('image')->store('public/upload/'); 
        //     $user->image = Storage::url($image_name);
        //     Input::file('image')->move($image_path, $image_name);
        //     $request->file('image')->move(
        //         base_path() . '/public/upload/', $image_name);
        // }
        $user = User::find(Auth::id());
        $newPassword = $request['old_password'];
        $oldPassword = User::find(Auth::id())->password;
        if (Hash::check($newPassword, $oldPassword)) {
            $user->password = Hash::make($request['new_password']);
            User::findOrFail($id)->update($request->all());
            $user->save();
            return redirect()->route('home')->with('success', 'Profile has been updated successfully..');
        }
        else{
            return redirect()->route('users.editAdmin',$user)->with('danger', 'Please Enter the correct old password');
        }
    }
    // =========================== User ==========================
    public function editUser(User $user)
    {   
        $user = Auth::user();
        return view('users.editUser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    { 
        $validatedData = $request->validate([
            'username' => ['string', 'max:255'],
            // 'image' => ['required'],
            'old_password' => ['required' , 'string', 'min:8'],
            'new_password' => ['string', 'min:8']
        ]);

        // if($request->hasFile('image')) {
        //     $image_name = $request->file('image')->getClientOriginalName();              
        //     $image_path = $request->file('image')->store('public/upload/'); 
        //     $user->image = Storage::url($image_name);
        //     Input::file('image')->move($image_path, $image_name);
        //     $request->file('image')->move(
        //         base_path() . '/public/upload/', $image_name);
        // }
        $user = User::find(Auth::id());
        $newPassword = $request['old_password'];
        $oldPassword = User::find(Auth::id())->password;
        if (Hash::check($newPassword, $oldPassword)) {
            $user->password = Hash::make($request['new_password']);
            User::findOrFail($id)->update($request->all());
            $user->save();
            return redirect()->route('userHome')->with('success', 'Profile has been updated successfully..');
        }
        else{
            return redirect()->route('users.editUser',$user)->with('danger', 'Please Enter the correct old password');
        }        
    }
    // ===============================================================
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
