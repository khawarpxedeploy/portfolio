<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Getway extends Model
{
    use HasFactory;

    public function usergetway(){
        return $this->hasOne('App\Models\Usergetway')->with('currencygetway');
    }

    public function usercreds(){
        return $this->hasOne('App\Models\Usergetway');
    }
}
