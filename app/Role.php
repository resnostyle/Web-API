<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    protected $guarded = [];

    const ROLE_DISABLED = 1;
    const ROLE_FREE = 2;
    const ROLE_VIP = 3;
    const ROLE_MODERATOR = 4;
    const ROLE_ADMIN = 5;

    private $_elevatedRoles = [

    ];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function defaultRole()
    {
        return static::where('is_default', true)->first();
    }

    public function isElevated() {
        return ($this->id >= self::ROLE_VIP);
    }
}
