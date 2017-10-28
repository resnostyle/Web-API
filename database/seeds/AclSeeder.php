<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultRoles = Role::roles();

        foreach ($defaultRoles as $role) {
            $r = new Role(
                [
                    'name' => $role['name'],
                    'display_name' => $role['display_name'],
                    'description' => $role['description']
                ]
            );
            $r->save();

            foreach ($role['permissions'] as $perm) {
                $p = new Permission([
                    'name' => $perm['name'],
                    'display_name' => $perm['display_name'],
                    'description' => $perm['description']
                ]);
                $p->save();

                $r->attachPermission($p);
            }
        }
        $memberRole = Role::defaultRole();
        $vipRole = Role::where('name', 'VIP')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $basicUser = App\User::find(2);

        $basicUser->attachRole($memberRole);

        $adminUser = App\User::find(1);
        $adminUser->attachRoles([$memberRole, $vipRole, $adminRole]);
    }
}
