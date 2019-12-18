<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostsController extends Controller
{
    //call middleware on create and store methods
    public function __construct(){
         $this->middleware('verifyCategoriesCount');
    }
    
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

 
    public function store(CreatePostRequest $request )
    {
        //upload the image to storage
        $image = $request->image->store('posts');
        
        //create the post
        $post = Post::create([
              'title' => $request->title,
              'description' => $request->description,
              'content' => $request->content,
              'image' => 'storage/'.$image,
              'published_at' => $request->published_at,
              'category_id' => $request->category,
              'user_id' => Auth::user()->id,
        ]);

         //get the tags and attach to the newly created post
         if($request->tags){
            $post->tags()->attach($request->tags);
        }


        //flash message
        session()->flash('success', 'Post created successfully');

        //redirect the user
        return redirect(route('posts.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //get all data in request
        $data = $request->only(['title', 'description', 'published_at', 'content']);

        //check if new image
        if($request->hasFile('image')){

        //upload it
        $image = $request->image->store('posts');

        //delete old one
        Storage::delete($post->image);
        
        //update attribute
        $data['image'] = 'storage/'.$image;
        }
  
        //Sync method to update tags
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        //flash message
        session()->flash('success', 'Post updated');

        //update post
        $post->update($data);

        //redirect user
        return redirect(route('posts.index'))->with('message', 'Post updated successfully');
    }

    public function destroy($id)
    {
        //locate this posts using ID and not route model binding cos it will not find the post in d db
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        //call a permanently delete method
        
        if($post->trashed()){
            Storage::delete($post->image); //Delete post image from the disk
            $post->forceDelete();
        }
        
        else
        //call a soft delete method
        $post->delete();

        session()->flash('Post successfully trashed');

        return redirect(route('posts.index'))->with('message', 'Post deleted successfully');
    }

    
    /**
     * Shows trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    //restore a deleted post
    public function restore($id){

        $post = Post::onlyTrashed()->where('id', $id)->firstOrFail();
        
        $post->restore();

        session()->flash('message', 'Post restored successfully');

        return redirect()->back();
    }
}
