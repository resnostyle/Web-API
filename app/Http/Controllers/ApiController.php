<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Transformers\ReleaseTransformer;
use App\Release;

class ApiController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        $releases = Release::where('category_id', 5000)->get();

        return fractal($releases, new ReleaseTransformer())->respond();
    }
}
