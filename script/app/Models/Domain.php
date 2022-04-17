<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $guarded = [];  

    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant', 'tenant_id')->with('username')->select('id','user_id');
    }
}
