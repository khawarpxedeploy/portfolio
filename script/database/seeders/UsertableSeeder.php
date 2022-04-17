<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Usermeta;
use App\Models\Useroption;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $super = User::create([
            'role_id'  => 1,
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('rootadmin'),
        ]);

        User::create([
            'role_id'  => 2,
            'name'     => 'user',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('rootadmin'),
        ]);

        $order1=Order::create([
            'invoice_no'=>'#123',
            'user_id'=>2,
            'plan_id'=>1,
            'getway_id'=>13,
            'trx'=>'sdfsdf',
            'tax'=>0,
            'will_expire'=>Carbon::now()->addDays(7)->format('Y-m-d'),
            'price'=>0,
            'status'=>1,
            'payment_status'=>1,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        $tenant=Tenant::create([
            'id'          => 'user',
            'order_id'    => $order1->id,
            'user_id'     => '2',
            'status'      => 1,
            'data'        => array('duration' => 0, 'storage_size' => 0, 'name' => 'Free', 'resume_builder' => 0, 'portfolio_builder' => 0, 'custom_domain' => 0, 'sub_domain' => 0, 'analytics' => 0, 'online_businesscard' => 0, 'qrcode' => 0, 'postlimit' => 0, 'is_featured' => 0, 'theme' => 'theme/default'),
            'will_expire' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
      
        $order1->Orderlog()->create(['tenant_id'=>'user']);


        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        //create permission
        $permissions = [
            [
                'group_name'  => 'dashboard',
                'permissions' => [
                    'dashboard.index',
                ],
            ],
            [
                'group_name'  => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.edit',
                    'admin.update',
                    'admin.delete',
                    'admin.list',
                ],
            ],
            [
                'group_name'  => 'role',
                'permissions' => [
                    'role.create',
                    'role.edit',
                    'role.update',
                    'role.delete',
                    'role.list',

                ],
            ],
            [
                'group_name'  => 'blog',
                'permissions' => [
                    'blog.create',
                    'blog.edit',
                    'blog.delete',
                    'blog.index',
                ],
            ],
            [
                'group_name'  => 'page',
                'permissions' => [
                    'page.create',
                    'page.edit',
                    'page.delete',
                    'page.index',

                ],
            ],
            [
                'group_name'  => 'theme-settings',
                'permissions' => [
                    'theme-settings',
                ],
            ],
            [
                'group_name'  => 'seo',
                'permissions' => [
                    'option.seo-index',
                    'option.seo-edit',
                ],
            ],
            [
                'group_name'  => 'profile',
                'permissions' => [
                    'profile.create',
                    'profile.index',
                ],
            ],
            [
                'group_name'  => 'plan',
                'permissions' => [
                    'plan.create',
                    'plan.edit',
                    'plan.delete',
                    'plan.index',

                ],
            ],
            [
                'group_name'  => 'payment-gateway',
                'permissions' => [
                    'payment-gateway.create',
                    'payment-gateway.edit',
                    'payment-gateway.delete',
                    'payment-gateway.index',

                ],
            ],
            [
                'group_name'  => 'order',
                'permissions' => [
                    'order.create',
                    'order.edit',
                    'order.delete',
                    'order.index',
                    'order.show',

                ],
            ],
            [
                'group_name'  => 'domain',
                'permissions' => [
                    'domain.create',
                    'domain.edit',
                    'domain.delete',
                    'domain.index',

                ],
            ],
            [
                'group_name'  => 'customer',
                'permissions' => [
                    'customer.create',
                    'customer.edit',
                    'customer.delete',
                    'customer.index',
                    'customer.show',

                ],
            ],
            [
                'group_name'  => 'cron',
                'permissions' => [
                    'cron',

                ],
            ],
            [
                'group_name'  => 'report',
                'permissions' => [
                    'report.index',
                    'report.edit',
                    'report.view',
                    'report.invoice-pdf',

                ],
            ],
            [
                'group_name'  => 'tenant',
                'permissions' => [
                    'tenant.index',
                    'tenant.edit',
                    'tenant.view',
                ],
            ],
            [
                'group_name'  => 'language',
                'permissions' => [
                    'language.index',
                    'language.create',
                    'language.delete',

                ],
            ],
            [
                'group_name'  => 'benefit',
                'permissions' => [
                    'benefit.index',
                    'benefit.create',
                    'benefit.delete',
                    'benefit.edit',

                ],
            ],
            [
                'group_name'  => 'template-image',
                'permissions' => [
                    'template-image.index',
                    'template-image.create',
                    'template-image.delete',
                    'template-image.edit',

                ],
            ],
            [
                'group_name'  => 'template',
                'permissions' => [
                    'template.index',
                    'template.create',
                    'template.delete',
                    'template.edit',

                ],
            ],
            [
                'group_name'  => 'company',
                'permissions' => [
                    'company.index',
                    'company.create',
                    'company.delete',
                    'company.edit',

                ],
            ],
            [
                'group_name'  => 'menu',
                'permissions' => [
                    'menu',
                ],
            ],
            [
                'group_name'  => 'config_dns',
                'permissions' => [
                    'config_dns',
                ],
            ],
        ];

        //assign permission
        foreach ($permissions as $key => $row) {
            foreach ($row['permissions'] as $per) {
                $permission = Permission::create(['name' => $per, 'group_name' => $row['group_name']]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
                $super->assignRole($roleSuperAdmin);
            }
        }
    }
}
