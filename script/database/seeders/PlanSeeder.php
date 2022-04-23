<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
          [
            "id" => 1,
            "name" => "Trial",
            "duration" => 14,
            "price" => 0,
            "storage_size" => 25,
            "resume_builder" => 0,
            "portfolio_builder" => 0,
            "custom_domain" => 0,
            "sub_domain" => 0,
            "analytics" => 1,
            "online_businesscard" => 1,
            "qrcode" => 1,
            "postlimit" => 25,
            "is_featured" => 1,
            "online_cv" => 0,
            "vcard" => 0,
            "status" => 1,
            "is_trial" => 1,
            "is_default" => 0,
            "data" => "null",
            "created_at" => "2021-05-04 08:42:47",
            "updated_at" => "2021-07-24 14:06:40"
          ],
          [
            "id" => 2,
            "name" => "Basic",
            "duration" => 30,
            "price" => 11.99,
            "storage_size" => 100,
            "resume_builder" => 1,
            "portfolio_builder" => 1,
            "custom_domain" => 1,
            "sub_domain" => 0,
            "analytics" => 1,
            "online_businesscard" => 1,
            "qrcode" => 1,
            "postlimit" => 100,
            "is_featured" => 1,
            "online_cv" => 0,
            "vcard" => 0,
            "status" => 1,
            "is_trial" => 0,
            "is_default" => 0,
            "data" => "null",
            "created_at" => "2021-05-04 08:42:47",
            "updated_at" => "2021-07-24 14:07:02"
          ],
          [
            "id" => 3,
            "name" => "Premium",
            "duration" => 30,
            "price" => 25.99,
            "storage_size" => 200,
            "resume_builder" => 1,
            "portfolio_builder" => 1,
            "custom_domain" => 0,
            "sub_domain" => 1,
            "analytics" => 1,
            "online_businesscard" => 1,
            "qrcode" => 1,
            "postlimit" => 100,
            "is_featured" => 1,
            "online_cv" => 1,
            "vcard" => 1,
            "status" => 1,
            "is_trial" => 0,
            "is_default" => 0,
            "data" => "null",
            "created_at" => "2021-07-24 14:01:53",
            "updated_at" => "2021-07-24 14:07:11"
          ],
          [
            "id" => 4,
            "name" => "Advanced",
            "duration" => 30,
            "price" => 49.99,
            "storage_size" => 500,
            "resume_builder" => 1,
            "portfolio_builder" => 1,
            "custom_domain" => 1,
            "sub_domain" => 1,
            "analytics" => 1,
            "online_businesscard" => 1,
            "qrcode" => 1,
            "postlimit" => 150,
            "is_featured" => 1,
            "online_cv" => 1,
            "vcard" => 1,
            "status" => 1,
            "is_trial" => 0,
            "is_default" => 0,
            "data" => "null",
            "created_at" => "2021-07-24 14:05:20",
            "updated_at" => "2021-07-24 14:06:15"
          ]
        ];

        Plan::insert($plans);        
    }
}
