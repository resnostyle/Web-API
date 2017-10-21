<?php 
/**
 * Role Model File
 * 
 * PHP version 7.1
 *
 * @category Model
 * @package  App
 * @author   Zetas <zetas@zet.as>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://laranzedb.github.io/
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Role Model
 * 
 * Model providing ACP for LaranZEDb. The various roles control what resources
 * the users can access.
 * 
 * @category Model
 * @package  App
 * @author   Zetas <zetas@zet.as>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://laranzedb.github.io/
 */ 
class Role extends Model
{
    protected $guarded = [];

    const ROLE_DISABLED = 1;
    const ROLE_FREE = 2;
    const ROLE_VIP = 3;
    const ROLE_MODERATOR = 4;
    const ROLE_ADMIN = 5;

    const ROLES_ELEVATED = [
        self::ROLE_VIP,
        self::ROLE_MODERATOR,
        self::ROLE_ADMIN
    ];

    public $timestamps = false;

    /**
     * User relationship
     * 
     * Provides access to the 1toMany relationship between Users and Roles.
     *
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Default Role
     * 
     * Returns the role marked as default in the database. Will throw an exception
     * if there is no default or no roles added. 
     * 
     * @return Role $role
     */
    public static function defaultRole()
    {
        return static::where('is_default', true)->firstOrFail();
    }

    /**
     * Elevation check
     * 
     * Returns true if the role is considered "elevated". That means VIP or Above.
     * Used mainly to check for access to the premium sections of the site.
     *
     * @return boolean
     */
    public function isElevated() 
    {
        return in_array($this->id, self::ROLES_ELEVATED);
    }
}
