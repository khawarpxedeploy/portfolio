<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
        ->select('group_name as name')
        ->groupBy('group_name')
        ->get();
        return $permission_groups;
    }

    public static function getPermissionGroup()
    {
        return $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
    }
    
    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
        ->select('name', 'id')
        ->where('group_name', $group_name)
        ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }

    public function active_orders(){
        return $this->hasMany('App\Models\Order','user_id', 'id')->where('status', 1);
    }

    public function orders(){
        return $this->hasMany('App\Models\Order','user_id', 'id');
    }

    public function tenant(){
        return $this->hasOne('App\Models\Tenant','user_id', 'id');
    }

    public function vcard(){
        return $this->hasOne('App\Models\Useroption','user_id', 'id')->where('key','vcard');
    }

    public function cv(){
        return $this->hasOne('App\Models\Usermeta','user_id', 'id')->where('key','cv');
    }
}
