<?php
/**
 * User Model File
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

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * User Model
 * 
 * Model providing access to user data.
 * 
 * @category Model
 * @package  App
 * @author   Zetas <zetas@zet.as>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://laranzedb.github.io/
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Role relationship
     *
     * Provides inverse access to the 1toMany relationship betweens Users and Roles.
     * 
     * @example $user->role->id;
     * @return  Builder $query
     */
    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Inviter relationship
     * 
     * Provides accesss to the 1to1 relationship between a user and whoever 
     * invited them (another user).
     *
     * @return Builder $query
     */
    public function inviter() 
    {
        return $this->belongsTo(__CLASS__, 'id', 'invited_by');
    }

    /**
     * SentInvites Relationship
     * 
     * Provides access to the 1toMany relationship between a user and 
     * the invites they sent out.
     *
     * @return Builder $query
     */
    public function sentInvites() 
    {
        return $this->hasMany(Invite::class);
    }

    /**
     * Email attribute accessor
     * 
     * Emails are stored encrypted in the database. This accessor decrypts the email
     * for use. This happens automatically and this method should never need to be
     * accessed manually.
     *
     * @param string $email Encrypted email
     * 
     * @return string $email Decrypted email
     */
    public function getEmailAttribute($email) 
    {
        return decrypt($email);
    }

    /**
     * Email attribute mutator
     * 
     * Emails are stored encrypted in the database. This mutator encrypts the email
     * for storage in the database. This happens automatically and this method should
     * never need to be accessed manually.
     * 
     * @param string $email Plaintext Email
     * 
     * @return void
     */
    public function setEmailAttribute($email) {
        $this->attributes['email'] = encrypt($email);
    }
}
