<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::with('users')->get();
        // dd($posts[0]->users->name);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request)
    {
        $posts = $request->all();
        $create = new Post;
        $create->title = $request->title;
        $create->content = $request->content;
        $create->user_id = auth()->id();

        if($create->save()){
            $posts = Post::all();
            return view('posts.index')->with('posts',$posts);
        }
       else{
        dd('here');
       }



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     $post= Post::where('id', $id)->first();

    //  dd($post[0]);
       return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $postuser= Post::where('id', $id)->first();

        if(auth()->id() == $postuser->user_id){
            
            $post= Post::where('id', $id)->update(['title' => $request->title,'content' => $request->content, ]);
            
        }

         $posts = Post::with('users')->get();
        // dd($posts[0]->users->name);
        return view('posts.index')->with('posts',$posts);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
            $post= Post::where('id', $id)->get();
            dd($post[0]->user_id);
            if(auth()->id() == $post[0]->user_id);
            {
                 $post->each->delete();
            } 
            
            
       


        
        
        $posts = Post::with('users')->get();
        // dd($posts[0]->users->name);
        return view('posts.index')->with('posts',$posts);
    }
}
