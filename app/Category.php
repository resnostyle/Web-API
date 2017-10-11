<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Category extends Model
{
    use HybridRelations;
    protected $guarded = [];

    protected $connection = 'mysql';

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function releases() {
        return $this->hasMany(Release::class);
    }

    public function parent() {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function scopeActive(Builder $query) {
        return $query->where('active', true);
    }
}
