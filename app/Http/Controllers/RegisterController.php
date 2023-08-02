<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return the create page
        return view('register.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return the create page
        return view('register.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //validate the input fields
        $attributes = request()->validate([
            'name'=>['required','min:3','max:255', Rule::unique('users','name')],
            'email'=>['required','email','min:3','max:255', Rule::unique('users','email')],
            //i hashed the password and it is done in my user.php file using mutator
            'password'=>['required','min:7','max:255'],
            'confirm_password'=>['required','min:7','max:255']
        ]);

        //create new user if the validation is passed
        $newUser = User::create($attributes);

        // //Login the user
            Auth::login($newUser);

        //return redirect to the home page with a success message
        return redirect('/posts')->with('success','Your account was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //Log user out
        return ddd('log out user');
    }
}
