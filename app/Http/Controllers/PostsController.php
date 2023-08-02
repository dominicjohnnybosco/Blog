<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Display all the posts in decreasing order
        $posts = Post::orderBy('created_at','desc')->get();

        //return index page
        return view('posts.home')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the input field
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => ['image','mimes:jpeg,png,jpg,gif','max:4096','nullable']
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){

            //Hand file Size
            $image = $request->file('cover_image');
            $maxSize = 4096; //i set it to 4mb

            if($image->getSize() > $maxSize * 1024){
                return redirect()->route('posts.create')->withInput()->withErrors(['image' => 'image size should not exceed 4 MB']);
            }

            // Get the filename with the extension
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

            // Get Just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName. '_' . time() . '.' .$extension;

            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

         //creating a new post object
         $insert_post_to_db = new Post();

        //insert the validated input into the database
        $insert_post_to_db->title = $request->input('title');

        $insert_post_to_db->body = $request->input('body');

        //linking the user id in the user id with the user_id in the post table
        $insert_post_to_db->user_id = auth()->user()->id ;

        //insert the image name to the cover_image column in the post table
        $insert_post_to_db->cover_image = $fileNameToStore;

        //save the created post
        $insert_post_to_db->save();

        //return redirect to the index page
        return redirect('/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find and show a post by id
        $showSinglePost = Post::find($id);

        //return the single show page
        return view('posts.show')->with('showSinglePost',$showSinglePost);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find and edit a post by id
        $edit_post = Post::find($id);

        //return the edit post page
        return view('posts.edit')->with('edit_post',$edit_post);
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
        //validate the input field
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => ['image','mimes:jpeg,png,jpg,gif','max:4096','nullable']

        ]);

        //Handle file upload for update
        if($request->hasFile('cover_image')){

            //Hand file Size
            $image = $request->file('cover_image');
            $maxSize = 4096; //i set it to 4mb

            if($image->getSize() > $maxSize * 1024){
                return redirect()->route('posts.edit')->withInput()->withErrors(['image' => 'image size should not exceed 4 MB']);
            }

            // Get the filename with the extension
            $fileNameWithExtension = $request->file('cover_image')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

            // Get Just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName. '_' . time() . '.' .$extension;

            // Upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }

        //find the post to update using id
        $update_post = Post::find($id);
        $update_post->title = $request->input('title');
        $update_post->body = $request->input('body');

        if($request->hasFile('cover_image')){
           $update_post->cover_image = $fileNameToStore;
        }

        //save the updated post
        $update_post->save();

        //return redirect to index page
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a post by its id
        $delete_post = Post::find($id);

        //delete the image along with the post

        //Check it's not the default image
        if($delete_post->cover_image != 'noimage.jpg'){
            //Delete the image
            Storage::delete('public/cover_images/' . $delete_post->cover_image);
        }
        //Delete the post
        $delete_post->delete();

        //return redirect to index page
        return redirect('/posts');
    }
}
