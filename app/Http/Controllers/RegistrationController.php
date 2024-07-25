<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('auth.register') ;
    }

    public function store(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required' , 'email'],
            'password' => ['required', 'confirmed' ]
        ]); 
        // create

        $user = User::create($attributes);
        //login
        Auth::login($user) ;
        //redirect
        return redirect()->route('posts.index');
    }
}
