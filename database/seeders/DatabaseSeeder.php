<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PermissionTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateSuperAdmin::class);
        $this->call(SettingTableSeeder::class);
    }
}
