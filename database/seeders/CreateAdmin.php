<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = User::whereuser_type('Admin')->latest()->first();
        if (is_null($info)) {
            $admin = new User();
            $admin->name = 'Admin';
            $admin->username = 'admin';
            $admin->username = 'admin';
            $admin->user_type = 'Admin';
            $admin->phone = '0177100001';
            $admin->email = 'admin@gmail.com';
            $admin->password = Hash::make('admin1234');
            $admin->created_by_user_id = '1';
            $admin->updated_by_user_id = '1';
            $profile=new Profile();
            $profile->user_id=  $admin->id;
            $profile->gender='Male';
            $profile->country='Bangladesh';
            $profile->save();
            $admin->status = '1';
            if ($admin->save()) {
            $admin = User::whereuser_type('Admin')->first();
            $admin->assignRole('Super Admin');
            $permission = Permission::pluck('name');
            $role = Role::wherename('Super Admin')->first();
            $role->syncPermissions($permission);
                
            }
           


        } else {
            $admin = User::whereuser_type('Admin')->first();
            $admin->assignRole('Super Admin');
            $permission = Permission::pluck('name');
            $role = Role::wherename('Super Admin')->first();
            $role->syncPermissions($permission);
        }
    }
}
