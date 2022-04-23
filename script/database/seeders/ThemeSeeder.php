<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
           
            ['id' => '2', 'type' => 'theme', 'name' => 'Default', 'view_path' => 'theme/default', 'asset_path' => 'theme/default', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '3', 'type' => 'theme', 'name' => 'Arafa', 'view_path' => 'theme/arafa', 'asset_path' => 'theme/arafa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '4', 'type' => 'vcard', 'name' => 'business', 'view_path' => 'vcard/business', 'asset_path' => 'vcard/business', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '5', 'type' => 'vcard', 'name' => 'classic', 'view_path' => 'vcard/classic', 'asset_path' => 'vcard/classic', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '6', 'type' => 'cv', 'name' => 'theme1', 'view_path' => 'cv/theme1', 'asset_path' => 'cv/theme1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '7', 'type' => 'cv', 'name' => 'theme2', 'view_path' => 'cv/theme2', 'asset_path' => 'cv/theme2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '8', 'type' => 'cv', 'name' => 'theme3', 'view_path' => 'cv/theme3', 'asset_path' => 'cv/theme3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '9', 'type' => 'cv', 'name' => 'theme4', 'view_path' => 'cv/theme4', 'asset_path' => 'cv/theme4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '10', 'type' => 'cv', 'name' => 'theme5', 'view_path' => 'cv/theme5', 'asset_path' => 'cv/theme5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '11', 'type' => 'theme', 'name' => 'Porto', 'view_path' => 'theme/porto', 'asset_path' => 'theme/porto', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '12', 'type' => 'theme', 'name' => 'Maru', 'view_path' => 'theme/maru', 'asset_path' => 'theme/maru', 'created_at' => now(), 'updated_at' => now()],
        ];
        

        Theme::insert($themes);
    }
}
