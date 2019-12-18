<?php

namespace App;

use App\Tag;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
