<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
   
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    public function getway()
    {
        return $this->belongsTo(Getway::class, 'getway_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tenant()
    {
        return $this->hasOne('App\Models\Tenant');
    }

    public function ordermeta()
    {
        return $this->hasOne('App\Models\Ordermeta')->where('key','orderinfo');
    }

     public function Orderlog()
    {
        return $this->hasMany('App\Models\Orderlog');
    }
}
