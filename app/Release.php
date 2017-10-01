<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Release
 *
 * @package App
 */
class Release extends Model
{
    protected $guarded = [];
    protected $connection = 'mongodb';

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
