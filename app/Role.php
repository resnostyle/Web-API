<?php namespace App;

use Illuminate\Database\Eloquent\Builder;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    const DEFAULT_ROLE = 'member';

    /**
     * Array of default roles and permissions for the site.
     * Only used during initial application setup.
     *
     * @return array
     */
    public static function roles()
    {
        return [
            [
                'name'         => self::DEFAULT_ROLE,
                'display_name' => ucfirst(self::DEFAULT_ROLE),
                'description'  => 'Default Role',
                'permissions'  => [
                    [
                        'name'         => 'view-profile',
                        'display_name' => 'View Profile',
                        'description'  => 'User can view their own profile',
                    ],
                    [
                        'name'         => 'edit-profile',
                        'display_name' => 'Edit Profile',
                        'description'  => 'User can edit their own profile',
                    ],
                    [
                        'name'         => 'report-release',
                        'display_name' => 'Report Release',
                        'description'  => 'Report bad release',
                    ],
                    [
                        'name'         => 'view-coverflow',
                        'display_name' => 'View Coverflow',
                        'description'  => 'View release list by cover image',
                    ],
                    [
                        'name'         => 'send-invite',
                        'display_name' => 'Send Invite',
                        'description'  => 'Send invites to people via email',
                    ],
                ],
            ],
            [
                'name'         => 'vip',
                'display_name' => 'VIP',
                'description'  => 'Premium Members',
                'permissions'  => [
                    [
                        'name'         => 'view-popular',
                        'display_name' => 'View Popular',
                        'description'  => 'View popular releases',
                    ],
                    [
                        'name'         => 'view-in_theaters',
                        'display_name' => 'View In Theaters',
                        'description'  => 'View In Theaters list',
                    ],
                    [
                        'name'         => 'use-downloader_integration',
                        'display_name' => 'Use Downloader Integration',
                        'description'  => 'Send releases to SabNZBd or NZBGet',
                    ],
                    [
                        'name'         => 'use-cp_integration',
                        'display_name' => 'Use Couchpotato Integration',
                        'description'  => 'Send movies to Couchpotato',
                    ],
                    [
                        'name'         => 'view-series',
                        'display_name' => 'View Series',
                        'description'  => 'View TV Series List',
                    ],
                    [
                        'name'         => 'view-my_movies',
                        'display_name' => 'View My Movies',
                        'description'  => 'View My Movies List',
                    ],
                    [
                        'name'         => 'add-my_movies',
                        'display_name' => 'Add My Movies',
                        'description'  => 'Add movies to the my movies list',
                    ],
                    [
                        'name'         => 'delete-my_movies',
                        'display_name' => 'Delete My Movies',
                        'description'  => 'Delete movies from the my movies list',
                    ],
                    [
                        'name'         => 'syndicate-my_movies',
                        'display_name' => 'Syndicate My Movies',
                        'description'  => 'View RSS Feed of My Movies',
                    ],
                    [
                        'name'         => 'view-my_shows',
                        'display_name' => 'View My Shows',
                        'description'  => 'View My Shows List',
                    ],
                    [
                        'name'         => 'add-my_shows',
                        'display_name' => 'Add My Shows',
                        'description'  => 'Add movies to the my shows list',
                    ],
                    [
                        'name'         => 'delete-my_shows',
                        'display_name' => 'Delete My Shows',
                        'description'  => 'Delete movies from the my shows list',
                    ],
                    [
                        'name'         => 'syndicate-my_shows',
                        'display_name' => 'Syndicate My Shows',
                        'description'  => 'View RSS Feed of My Shows',
                    ],

                ],
            ],
            [
                'name'         => 'moderator',
                'display_name' => 'Moderator',
                'description'  => 'Site Moderator, Elevated Access',
                'permissions'  => [
                    [
                        'name'         => 'view-mod_queue',
                        'display_name' => 'View Moderation Queue',
                        'description'  => 'View Release Reports made by Users',
                    ],
                    [
                        'name'         => 'delete-mod_queue',
                        'display_name' => 'Delete Moderation Queue Item',
                        'description'  => 'Close/delete moderation queue item',
                    ],
                    [
                        'name'         => 'edit-release',
                        'display_name' => 'Edit Release',
                        'description'  => 'Edit release information',
                    ],
                    [
                        'name'         => 'delete-release',
                        'display_name' => 'Delete Release',
                        'description'  => 'Delete a release from the site',
                    ],
                    [
                        'name'         => 'edit-series',
                        'display_name' => 'Edit TV Series',
                        'description'  => 'Edit TV Series information',
                    ],
                    [
                        'name'         => 'view-predb',
                        'display_name' => 'View PreDB',
                        'description'  => 'View PreDB List',
                    ],
                ],
            ],
            [
                'name'         => 'admin',
                'display_name' => 'Administrator',
                'description'  => 'Super User',
                'permissions'  => [
                    [
                        'name'         => 'view-admin_dashboard',
                        'display_name' => 'View Admin Dashboard',
                        'description'  => 'View the Admin Dashboard',
                    ],
                    [
                        'name'         => 'view-other_user_profile',
                        'display_name' => 'View User Profiles',
                        'description'  => 'View other users profiles',
                    ],
                    [
                        'name'         => 'edit-other_user_profile',
                        'display_name' => 'Edit User Profiles',
                        'description'  => 'Edit other users profiles',
                    ],
                    [
                        'name'         => 'create-user',
                        'display_name' => 'Create Users',
                        'description'  => 'Allows user to create other users',
                    ],
                    [
                        'name'         => 'delete-user',
                        'display_name' => 'Delete Users',
                        'description'  => 'Allows user to delete other users',
                    ],
                ],
            ],
        ];
    }

    public function resources() {
        return $this->belongsToMany(Resource::class)->withPivot('value');
    }

    public function scopeWithResource(Builder $query, $name) {
        return $query->whereHas('resources', function($query) use($name) {
            $query->where('name', $name);
        })->with('resources');
    }

    public static function defaultRole() {
        return Role::where('name',self::DEFAULT_ROLE)->first();
    }
}