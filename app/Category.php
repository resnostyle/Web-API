<?php
/**
 * Category Model File
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

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

/**
 * Category Model - Hybrid
 * 
 * Hybrid model for categorizing releases. This model is MySQL whereas 
 * Releases are MongoDB. 
 * 
 * @category Model
 * @package  App
 * @author   Zetas <zetas@zet.as>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://laranzedb.github.io/
 */ 
class Category extends Model
{
    use HybridRelations;
    protected $guarded = [];

    protected $connection = 'mysql';

    /**
     * Return database field to use as route name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'title';
    }

    /**
     * Releases Relationship
     *
     * Provides access to the hybrid releases 1toMany relationship.
     * 
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function releases() 
    {
        return $this->hasMany(Release::class);
    }

    /**
     * Parent Category Relationship
     *
     * Provides inverse access to an optional 1to1 relationship with
     * a parent Category (i.e. ->Movies<-/HD)
     * 
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function parent() 
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * Child Category Relationship
     * 
     * Provices access to an optional 1toMany relationship with
     * it's children categories (i.e. Movies/->HD<-)
     *
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function children() 
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * Query scope for active categories
     *
     * This adds a where filter to the query builder so it only returns 
     * active categories.
     * 
     * @param Illuminate\Database\Eloquent\Builder $query Query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }
}
