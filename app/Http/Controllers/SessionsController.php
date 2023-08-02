<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function store(){
        //validate the request to login
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //authenticate and login the user
        //based on the provided input
        if(Auth::attempt($attributes)){
            session()->regenerate();
           //redirect the user to the homepage.
            return redirect('/profile')->with('success','Welcome Back');
        };

        //if the authentication fails
        throw ValidationException::withMessages([
            'email' => 'Your Provided Credential Could Not Be Verified'
        ]);



    }

    public function create(){

        return view('sessions.create');
    }

    public function destroy(){
        //logout the user
        Auth::logout();

        //return redirect to home page
        return redirect('/posts')->with('success','Goodbye User');
    }
}
