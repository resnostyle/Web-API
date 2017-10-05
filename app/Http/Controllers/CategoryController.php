<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        return view('category.browse', compact('category'));
    }

}
