<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            ['name'=>'super-admin','display_name'=>'Super Admin','group'=>'system','guard_name'=>'web'],
            ['name'=>'admin','display_name'=>'Admin','group'=>'system','guard_name'=>'web'],
            ['name'=>'employee','display_name'=>'employee','group'=>'system','guard_name'=>'web'],
            ['name'=>'manager','display_name'=>'manager','group'=>'system','guard_name'=>'web'],
            ['name'=>'user','display_name'=>'user','group'=>'system','guard_name'=>'web'],
        ];
        foreach($roles as $role){
            Role::updateOrCreate($role);
        }

        $permissions=[
            ['name'=>'create-user','display_name'=>'Create user','group'=>'User','guard_name'=>'web'],
            ['name'=>'update-user','display_name'=>'Update user','group'=>'User','guard_name'=>'web'],
            ['name'=>'show-user','display_name'=>'Show user','group'=>'User','guard_name'=>'web'],
            ['name'=>'delete-user','display_name'=>'Delete user','group'=>'User','guard_name'=>'web'],

            ['name'=>'create-role','display_name'=>'Create role','group'=>'Role','guard_name'=>'web'],
            ['name'=>'update-role','display_name'=>'Update role','group'=>'Role','guard_name'=>'web'],
            ['name'=>'show-role','display_name'=>'Show role','group'=>'Role','guard_name'=>'web'],
            ['name'=>'delete-role','display_name'=>'Delete role','group'=>'Role','guard_name'=>'web'],

            ['name'=>'create-category','display_name'=>'Create category','group'=>'Category','guard_name'=>'web'],
            ['name'=>'update-category','display_name'=>'Update category','group'=>'Category','guard_name'=>'web'],
            ['name'=>'show-category','display_name'=>'Show category','group'=>'Category','guard_name'=>'web'],
            ['name'=>'delete-category','display_name'=>'Delete category','group'=>'Category','guard_name'=>'web'],

            ['name'=>'create-product','display_name'=>'Create product','group'=>'Product','guard_name'=>'web'],
            ['name'=>'update-product','display_name'=>'Update product','group'=>'Product','guard_name'=>'web'],
            ['name'=>'show-product','display_name'=>'Show product','group'=>'Product','guard_name'=>'web'],
            ['name'=>'delete-product','display_name'=>'Delete product','group'=>'Product','guard_name'=>'web'],
            
            ['name'=>'create-coupon','display_name'=>'Create coupon','group'=>'Coupon','guard_name'=>'web'],
            ['name'=>'update-coupon','display_name'=>'Update coupont','group'=>'Coupon','guard_name'=>'web'],
            ['name'=>'show-coupon','display_name'=>'Show coupon','group'=>'Coupon','guard_name'=>'web'],
            ['name'=>'delete-coupon','display_name'=>'Delete coupon','group'=>'Coupon','guard_name'=>'web'],
        ];
        foreach($permissions as $permission){ 
            Permission::updateOrCreate($permission);
        }
    }
}
