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
        $vipRole = Role::where('name', 'vip')->first();
        $moderatorRole = Role::where('name', 'moderator')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $basicUser = App\User::find(2);

        $basicUser->attachRole($memberRole);

        $adminUser = App\User::find(1);
        $adminUser->attachRoles([$memberRole, $vipRole, $moderatorRole, $adminRole]);

        foreach (App\User::where('id', '!=', 1)->where('id', '!=', 2)->get() as $user) {
            $choice = rand(1,7);

            if ($choice >= 4) {
                $user->attachRole($memberRole);
            } elseif ($choice >= 2) {
                $user->attachRole($vipRole);
            } elseif ($choice == 1) {
                $user->attachRole($moderatorRole);
            }
        }

        // Resources

        $api_hits = App\Resource::create([
            'name' => 'api_hits',
            'display_name' => 'API Hits',
            'description' => 'User API hits in the last 24 hours.'
        ]);

        $downloads = App\Resource::create([
            'name' => 'downloads',
            'display_name' => 'NZB Downloads',
            'description' => 'User NZB downloads in the last 24 hours.'
        ]);

        $memberRole->resources()->attach($api_hits, ['value' => 100]);
        $memberRole->resources()->attach($downloads, ['value' => 50]);

        // setting a number thats inclusive of the previous role.
        // @todo revist this, i dont know if i want them to be additive.
        // @note about the above todo: I'm not doing additive atm. Leaving the note as it's in flux.
        $vipRole->resources()->attach($api_hits, ['value' => 5000]);
        $vipRole->resources()->attach($downloads, ['value' => 500]);

        $moderatorRole->resources()->attach($api_hits, ['value' => 10000]);
        $moderatorRole->resources()->attach($downloads, ['value' => 1000]);
    }
}
