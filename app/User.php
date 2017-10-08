<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function inviter() {
        return $this->belongsTo(__CLASS__, 'id', 'invited_by');
    }

    public function sentInvites() {
        return $this->hasMany(Invite::class);
    }

    public function getEmailAttribute($email) {
        return decrypt($email);
    }

    public function setEmailAttribute($email) {
        $this->attributes['email'] = encrypt($email);
    }
}
