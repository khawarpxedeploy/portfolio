<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table      = "plans";
    protected $primaryKey = "id";
    protected $fillable   = [
        "name",
        "price",
        "duration",
        "storage_size",
        "resume_builder",
        "portfolio_builder",
        "custom_domain",
        "sub_domain",
        "analytics",
        "online_businesscard",
        "qrcode",
        "postlimit",
        "data",
        "is_featured",
        "status",
        "is_trial",
        "is_default",
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

     public function activeorders()
    {
        return $this->hasMany(Order::class)->where('status',1);
    }
}
