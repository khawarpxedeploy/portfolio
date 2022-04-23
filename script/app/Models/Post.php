<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'postcategories')->with('posts');
    }

    public function categoriesdata()
    {
        return $this->belongsToMany(Category::class, 'postcategories')->select('id');
    }
    // Relation To TermsMeta
    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id", 'id');
    }
    public function termMeta()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'service_meta');
    }
    public function quickStart()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'quick_start_meta');
    }

    // Relation To Postmeta
    public function page()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'page');
    }

    // Relation to Postmeta
    public function meta()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'content');
    }

    // Relation To Postmeta
    public function excerpt()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'excerpt');
    }

    // Relation To Postmeta
    public function thum_image()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'thum_image');
    }

    // Relation To Postmeta
    public function description()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'description', 'excerpt');
    }
    // Relation To Postmeta
    public function link()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'link');
    }
    public function icon()
    {
        return $this->hasOne(Postmeta::class, 'post_id')->where('key', 'icon');
    }

}
