<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = Setting::latest()->first();
        if (is_null($setting)) {
            $setting = new Setting();
            $setting->user_id = '1';
            $setting->name = 'SohiBD';
            $setting->title = 'Car Dekho BD';
            $setting->phone = '(281) 809-0090';
            $setting->email = 'info@cardekho.com';
            $setting->address = '30 Commercial Road Fratton, Australia';
            $setting->favicon = 'uploads/setting/default.png';
            $setting->logo = 'uploads/setting/default.png';
            $setting->footer_logo = 'uploads/setting/default.png';
            $setting->admin_logo = 'uploads/setting/default.png';
            $setting->facebook = '#';
            $setting->youtube = '#';
            $setting->twitter = '#';
            $setting->instagram = '#';
            $setting->status = '1';
            $setting->save();
        }
    }
}
