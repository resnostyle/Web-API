<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends SecureController
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $subcat = null)
    {
        if (!empty($subcat)) {
            if ($child = $category->children()->where('title', $subcat)->first()) {
                $category = $child;
            }
        }

        $releases = $category->releases;

        return view('category.browse', compact('releases', 'category'));
    }

}
