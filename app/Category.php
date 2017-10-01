<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Category extends Model
{
    use HybridRelations;
    protected $guarded = [];

    protected $connection = 'mysql';

    public function releases() {
        return $this->hasMany(Release::class);
    }

    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }
}
