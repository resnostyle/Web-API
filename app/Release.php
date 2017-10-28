<?php
/**
 * Release Model File
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
 * Release Model - MongoDB
 * 
 * Model providing access to mongodb-stored releases.
 * These have been ingested from an nZEDb indexer.
 * 
 * @category Model
 * @package  App
 * @author   Zetas <zetas@zet.as>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://laranzedb.github.io/
 */ 
class Release extends Model
{
    protected $guarded = [];
    protected $connection = 'mongodb';

    /**
     * Category Relationship
     * 
     * Provides inverse access to the 1toMany relationship between Categories
     * and Releases.
     *
     * @return \Illuminate\Database\Query\Builder $query
     */
    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Group Relationship
     * 
     * Provides inverse access to the ManyToMany relationship between Groups
     * and Releases.
     *
     * @return \Illuminate\Database\Query\Builder $query
     */
    public function groups() 
    {
        return $this->belongsToMany(Group::class);
    }
}
