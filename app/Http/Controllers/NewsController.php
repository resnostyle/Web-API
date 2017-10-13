<?php

namespace App\Http\Controllers;

class NewsController extends SecureController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('news');
    }
}
