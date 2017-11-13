<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public $guarded = [];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function roles() {
        return $this->belongsToMany(Role::class)->withPivot('value');
    }
}
