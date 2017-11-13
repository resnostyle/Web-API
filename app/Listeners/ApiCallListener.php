<?php

namespace App\Listeners;

use App\Events\ApiCallEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class ApiCallListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ApiCallEvent  $event
     * @return void
     */
    public function handle(ApiCallEvent $event)
    {
        $key = sprintf('users.%s:%d:%s:%.3f',
            $event->resource->name,
            $event->user->id,
            md5($event->url),
            microtime(true)
        );
        Redis::set($key,1);
        Redis::expire($key, 120);
    }
}
