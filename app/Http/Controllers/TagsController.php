<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTagRequest;

class TagsController extends Controller
{
 
    public function index()
    {
        return view('tag.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        Tag::create([
            'name' => $request->name
        ]);

        return redirect(route('tags.index'))->with('message', 'Tag added successfully');
    }

    public function show(Tag $tag)
    {
        
    }

    public function edit(Tag $tag)
    {
        return view('tag.create')->with('tag', $tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->update();

        return redirect(route('tags.index'))->with('message', 'Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
            session()->flash('message', 'Tag cannot be deleted because it has associated posts');
            return back();
        }
        $tag->delete();
      
        return redirect(route('tags.index'))->with('message', 'Tag deleted successfully');
    }
}
