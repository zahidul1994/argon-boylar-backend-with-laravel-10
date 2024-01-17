<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateSuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = User::latest()->first();
        if (is_null($info)) {
            $superAdmin = new User();
            $superAdmin->name = 'Super Admin';
            $superAdmin->username = 'superadmin';
            $superAdmin->username = 'superadmin';
            $superAdmin->user_type = 'Super Admin';
            $superAdmin->phone = '0177100000';
            $superAdmin->email = 'superadmin@gmail.com';
            $superAdmin->password = Hash::make('superadmin1234');
            $superAdmin->created_by_user_id = '1';
            $superAdmin->updated_by_user_id = '1';
            $profile=new Profile();
            $profile->user_id=  $superAdmin->id;
            $profile->gender='Male';
            $profile->country='Bangladesh';
            $profile->save();
            $superAdmin->status = '1';
            if ($superAdmin->save()) {
                $role = Role::create(['name' => 'Super Admin']);
                $superAdmin->assignRole('Super Admin');
                $permission = Permission::pluck('name');
                $role = Role::wherename('Super Admin')->first();
                $role->syncPermissions($permission);
                
            }
            DB::unprepared(file_get_contents('database/sql/countries.sql'));
            DB::unprepared(file_get_contents('database/sql/division_district_thana.sql'));


        } else {
            $superAdmin = User::first();
            $superAdmin->assignRole('Super Admin');
            $permission = Permission::pluck('name');
            $role = Role::wherename('Super Admin')->first();
            $role->syncPermissions($permission);
        }
    }
}
