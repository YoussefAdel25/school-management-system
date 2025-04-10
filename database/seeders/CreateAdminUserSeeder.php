<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // إنشاء المستخدم الإداري
        $user = User::Create([

            'name' => 'Youssif Adel',
            'email' => 'ayoussef843@gmail.com',
            'password' => bcrypt('12345678'),
            // 'roles_name' => '[Admin]',
            // 'status' => 'مفعل'
        ]);

        // إنشاء الدور الإداري
        // $role = Role::firstOrCreate(['name' => 'Admin']);

        // // جلب جميع الصلاحيات وإسنادها للدور
        // $permissions = Permission::pluck('name')->all();
        // $role->syncPermissions($permissions);

        // // إسناد الدور للمستخدم
        // $user->assignRole($role->name);



        // $role = Role::create(['name' => 'Admin']);
        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions($permissions);
        // $user->assignRole([$role->id]);
    }
}
