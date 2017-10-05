<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];
    protected $connection = 'mongodb';

    public function releases() {
        return $this->belongsToMany(Release::class);
    }
}
