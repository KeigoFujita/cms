<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'content', 'image', 'published_at', 'category_id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();;
    }


    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function present_description()
    {
        return Str::of(substr($this->description, 0, 100))->trim() . "...";
    }
}