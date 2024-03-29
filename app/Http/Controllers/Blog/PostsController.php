<?php

namespace App\Http\Controllers\Blog;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function show(Post $post){
        
       return view('blog.show')->with('post', $post)->with('posts', Post::all()); 
    }

    public function category(Category $category){

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->searched()->simplePaginate(3))   //searched query builder has been defined in the post model
            ->with('categories', Category::all())
            ->with('tags', Tag::all()); 

     }

     public function tag(Tag $tag){
       
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('posts', $tag->posts()->searched()->simplePaginate(3));
    }

}
