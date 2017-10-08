<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invite extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function sender() {
        return $this->belongsTo(User::class);
    }

    public function scopeFree(Builder $query) {
        return $query->where('user_id', null);
    }
}
