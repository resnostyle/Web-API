<?php
/**
 * Group Model File
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

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Group Model - MongoDB
 * 
 * MongoDB model for storing usenet groups.
 * 
 * @category Model
 * @package  App
 * @author   Zetas <zetas@zet.as>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://laranzedb.github.io/
 */ 
class Group extends Model
{
    protected $guarded = [];
    protected $connection = 'mongodb';

    /**
     * Release Relationship
     * 
     * Provides inverse access to the ManyToMany Release relationship.
     * Groups can have many Releases and Release can have many Groups.
     *
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function releases() 
    {
        return $this->belongsToMany(Release::class);
    }
}
