<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $user){
        return view('user.profile' , compact('user'));
    }
    public function edit(User $user){
        return view('user.edit' , compact('user'));
    }
    public function update(User $user , UpdateUserProfileRequest $upupr){
        $data = $upupr->safe()->collect();
        if($data['password'] == ''){
            unset ($data['password']);
        }
        else{
            $data['password'] = Hash::make($data['password']);
        }
        if($data->has('image')){
            $path = $upupr->file('image')->store('users' , 'public');
            $data['image'] = '/' . $path;
        }
        $data['privateaccont'] = $upupr->has('noprivate');
        $user->update($data->toArray());
        session()->flash('success',__("Your profile has update"));
        return redirect()->route('user_profile' , $user);
    
    
    }
    
}
