<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $guarded = [];

    public function sender() {
        return $this->belongsTo(User::class);
    }

    public function scopeFree($query) {
        return $query->where('user_id', null);
    }
}
