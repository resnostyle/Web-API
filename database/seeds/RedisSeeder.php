<?php

use Illuminate\Database\Seeder;

class RedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 1000000; $i++) {
            $user = App\User::inRandomOrder()->first()->id;
            $hash = str_random();
            $key = "users.api_hits:$user:$hash";
            Redis::incr($key);
            Redis::expire($key, 24*60*60);
        }
    }
}
