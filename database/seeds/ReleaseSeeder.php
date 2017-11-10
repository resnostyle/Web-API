<?php

use Illuminate\Database\Seeder;
use App\Release;
use App\Category;
use Mayconbordin\L5Fixtures\FixturesFacade as Fixtures;

class ReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Category::all()->isEmpty()) {
            Fixtures::up();
        }

        factory(Release::class, 1000)->create()->each(function (Release $r) {
            $rand = random_int(3,6);
            for ($i = 0; $i < $rand; $i++) {
                // Not a quick way to get a random mongo record, i would not use this in production.
                $r->groups()->attach(App\Group::take(1)->skip(rand(0, 99))->first()->id);
            }
        });
    }
}
