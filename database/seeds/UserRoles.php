<?php

use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;

class UserRoles extends Seeder
{
    public function run()
    {
        $permission = Permission::where('name','Access Admin')->first();
        if($permission === null)
        {
            $p = new Permission();
            $p->name ="Access Admin";
            $p->slug="access.admin";
            $p->description="Permit access to administrator utilities";
            $p->save();
        }

        $permission = Permission::where('name','Modify Data')->first();
        if($permission === null)
        {
            $p = new Permission();
            $p->name ="Modify Data";
            $p->slug="modify.data";
            $p->description="Permit ability to modify or add data";
            $p->save();
        }

        $permission = Permission::where('name','View Data')->first();
        if($permission === null)
        {
            $p = new Permission();
            $p->name ="View Data";
            $p->slug="view.data";
            $p->description="Permit ability to view data";
            $p->save();
        }
        $permission = Permission::where('name','Manage Farms')->first();
        if($permission === null)
        {
            $p = new Permission();
            $p->name ="Manage Farms";
            $p->slug="manage.farms";
            $p->description="Permit ability to manage farm information";
            $p->save();
        }

        $checkForAdmin = Role::where('name','admin')->first();
        if($checkForAdmin === null) {
            $admin = new Role();
            $admin->name = "admin";
            $admin->slug = "admin";
            $admin->description = "Administrator Account";
            $admin->save();
            //sync role permissions
            $admin->syncPermissions([1,2,3,4]);
            $admin->save();
        }
        $checkForGuest = Role::where('name','guest')->first();
        if($checkForGuest === null) {
            $guest = new Role();
            $guest->name = "guest";
            $guest->slug = "guest";
            $guest->description = "Limited Guest Account";
            $guest->save();
        }
        $checkForUser = Role::where('name','user')->first();
        if($checkForUser === null) {
            $user = new Role();
            $user->name = "user";
            $user->slug = "user";
            $user->description = "Standard User Account";
            $user->save();
            //sync role permissions
            $user->syncPermissions([2,3,4]);
            $user->save();
        }

    }
}