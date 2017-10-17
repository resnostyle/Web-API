<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Pull and order the categories for navbar display.
        // @TODO Gotta be a better way to do this
        View::composer('*', function ($view) {
            if (!Auth::check())
                return false;
            // Since this entire closure is executed on every page load, caching DB calls is key.
            $all_cats = Cache::rememberForever('categories', function() {
                return Category::active()->get();
            });

            $all_cats_sorted = $all_cats->sortBy('order');

            // Group the full category collection by parent
            $cat_groups = $all_cats_sorted->mapToGroups(function ($item, $key) {
                return [$item['parent_id'] => $item['title']];
            });

            // Loop through the parents and pull the list of children, building a new collection.
            // The result of this map is basically a one-to-one representation of the navbar.
            $cats = $cat_groups
                ->pull('') //Pull out the list of parent categories
                ->map(function ($item, $key) use ($cat_groups) {
                    $cat = Cache::rememberForever("category_$item", function() use ($item) {
                        return Category::where('title', $item)->first();
                    });
                    return [$item => $cat_groups->get($cat->id)->toArray()];
                 });

            // Collapsing the collection is neccesary due to the above map() function adding an additional array layer.
            $view->with('nav_cats', $cats->collapse());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
