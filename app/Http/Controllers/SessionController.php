<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login') ;
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required' , 'email'],
            'password' => ['required']
        ]) ;

        if (! Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'credentials didn match, sorry' 
            ]) ;
        }  ;
        $request->session()->regenerate() ;

        return redirect()->intended(route('posts.index'));   
    }
    public function destroy()
    {
        Auth::logout() ;
        return redirect()->route('home');
    }
}
