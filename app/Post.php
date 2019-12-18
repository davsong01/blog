<?php

namespace App;

use App\Tag;
use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    //treat the published_at column as a date so that we can be able to compare it with current dates
    protected $dates = [
        'published_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    //create many to many  relationship between posts and tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
 
    //create relationship for users and posts
    public function user(){
        return $this->belongsTo(User::class);
    }

     /**Get only the published post from the database */
     public function scopePublished($query){
           
        return $query->where('published_at', '<=', now());
       
    }

    /*****
     * Check if a post has tags
     *@return boot
     */
    public function hasTag($tagid){
        return in_array($tagid, $this->tags->pluck('id')->toArray());
    }

    /**Code for
     * Search, NOTE the naming convention is: scope...and then the
     * name of the method you want to use
     */
    public function scopeSearched($query){
        $search = request()->query('search');

        if(!$search){

           return $query->published();//incase there is no search, return only published posts

        }
            
            return $query->published()->where('title', 'LIKE', "%{$search}%");//incase of a search, filter only published posts
       
    }

   
}