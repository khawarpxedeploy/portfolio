<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcategory extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id')->with('thum_image', 'description');
    }
}
