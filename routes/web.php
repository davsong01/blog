<?php

use App\Http\Controllers\Blog\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//Public Routes
Route::get('/', 'WelcomeController@index')->name('welcome.index');

Route::get('/blog/posts/{post}', 'Blog\PostsController@show')->name('blog.show');

Route::get('/blog/categories/{category}', 'Blog\PostsController@category')->name('blog.category');

Route::get('/blog/tags/{tag}', 'Blog\PostsController@tag')->name('blog.tag');

//Admin Routes
Route::middleware(['auth'])->group(function () {
        // Your defined routes go here
        // Route::get('/categories/{category}/delete', 'CategoryController@destroy');
        Route::resource('categories', 'CategoryController');
        Route::resource('posts', 'PostsController')->middleware(['auth']);
        
        //We give the below route a name in order to use it in the index page
        Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');
        Route::patch('restore-posts/{post}', 'PostsController@restore')->name('restore-posts');
        Route::resource('tags', 'TagsController');
    });

Route::middleware(['auth', 'admin'])->group(function(){ //create and register the admin middleware in kernel

    Route::get('users/profile', 'UsersController@edit')->name('users.edit-profile');
    Route::patch('users/profile', 'UsersController@update')->name('users.update-profile');
    Route::resource('users', 'UsersController'); 

    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
});



// Route::middleware(['auth', 'admin'])->group(function(){
//     Route::get('users', 'UserController@index');
// });
