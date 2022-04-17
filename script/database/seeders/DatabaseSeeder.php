<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
             PaymentGatewaySeeder::class,
             PlanSeeder::class,
             UsertableSeeder::class,
             OptionSeeder::class,
             UserOptionSeeder::class,
             UserPostSeeder::class,
             ThemeSeeder::class,
        ]);
    }
}
