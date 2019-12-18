<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Category;
use App\Post;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index')->with('categories', Category::all());
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        /*I have made validation rules become request objects by doing php artisan make:request CreateCategoryRequest which is located in Illuminate\Http\Request\CreateCategoryRequest;
        We can now call the class in and automatically use the rules method therein
        */

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/categories')->with('message', 'Category added successfully');
    }

    public function edit(Category $category)
    {
        return view('category.create')->with('category', $category);
    }

    public function update(CreateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->update();

        return redirect('/categories')->with('message', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if($category->posts->count() > 0){
            return back()->with('message', 'Category cannot be deleted because it has associated posts');
        }

        $category->delete();
      
        return redirect('/categories')->with('message', 'Category deleted successfully');
    }

}
