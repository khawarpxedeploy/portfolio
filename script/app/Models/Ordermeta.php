<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordermeta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'key',
        'value',
        'order_id'
    ];
}
