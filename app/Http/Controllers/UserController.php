<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function store(Request $request){
    

    $request->validate([
         'name' => 'required',
         'email' => 'unique:users,email',
         'password' => 'required|min:6',
    ]);

    User::create([
      'name' => $request->name,
      'email' =>$request->email,
      'password'=> Hash::make($request->password),
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    return redirect()->route('mainpage')->with('success', 'User added successfully');
    
  }

  public function login(Request $request){
    $request->validate([
           'email' => 'required | email',
           'password' =>  'required', 
    ]);
        
      if(Auth::attempt($request->only('email','password'))){
     
        return redirect()->route('mainpage')->with('success', 'User login successfully');
      }

      return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
  }
}
