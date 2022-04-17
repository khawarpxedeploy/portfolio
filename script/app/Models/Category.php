<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'p_id', 'id')->with('categories');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'p_id', 'id');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'postcategories');
    }
    public function testimonial_meta()
    {
        return $this->hasOne(Categorymeta::class, 'category_id')->where('key', 'testimonial_meta');
    }
    public function experience_meta()
    {
        return $this->hasOne(Categorymeta::class, 'category_id')->where('key', 'experience_meta');
    }

    public function skill_meta()
    {
        return $this->hasOne(Categorymeta::class, 'category_id')->where('key', 'skill_meta');
    }

    public function education_meta()
    {
        return $this->hasOne(Categorymeta::class, 'category_id')->where('key', 'education_meta');
    }
    public function work_process_meta()
    {
        return $this->hasOne(Categorymeta::class, 'category_id')->where('key', 'work_process_meta');
    }
    public function my_team_meta()
    {
        return $this->hasOne(Categorymeta::class, 'category_id')->where('key', 'my_team_meta');
    }
}
