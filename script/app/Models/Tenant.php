<?php
namespace App\Models;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'user_id', 'will_expire', 'data', 'plan_info', 'status','order_id'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'order_id',
            'user_id',
            'will_expire',
            'data',
            'status',
        ];
    }

    public function subdomain()
    {
        return $this->hasOne('App\Models\Domain')->where('type',1);
    }

    public function customdomain()
    {
        return $this->hasOne('App\Models\Domain')->where('type',2);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function username()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->select('id','name');
    }

    public function domain()
    {
        return $this->hasMany('App\Models\Domain');
    }

    public function sub()
    {
        return $this->hasOne('App\Models\Domain')->where('type',1);
    }

    public function custom()
    {
        return $this->hasOne('App\Models\Domain')->where('type',2);
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id');
    }

    public function Orderlog()
    {
        return $this->hasMany('App\Models\Orderlog');
    }

    public function tenantmeta()
    {
        return $this->hasOne('App\Models\Tenantmeta','tenant_id');
    }

    public function domainInfo()
    {
        return $this->hasMany('App\Models\Domain')->where('type','!=',0);
    }

    public function orderwithplan()
    {
        return $this->belongsTo('App\Models\Order','order_id')->with('plan');
    }

}
