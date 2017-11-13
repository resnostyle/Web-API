<?php

namespace App\Events;

use App\Resource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\User;

class ApiCallEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $resource;
    public $url;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Resource $res, $url)
    {
        $this->user = $user;
        $this->resource = $res;
        $this->url = $url;
    }


}
