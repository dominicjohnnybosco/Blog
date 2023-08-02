<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class DashboardController extends Controller
{
    //
    public function index(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        //return the dashboard page
        return view('dashboard.dashboard')->with('posts',$user->posts);
    }

    public function edit($id)
    {
        //find and edit a post by id
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
    }
}
