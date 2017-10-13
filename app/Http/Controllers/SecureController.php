<?php

namespace App\Http\Controllers;


class SecureController extends Controller {

    protected $except = [];
    protected $only = [];

    public function __construct()
    {
        if (filled($this->except)) {
            $this->middleware('auth')->except($this->except);
        } elseif (filled($this->only)) {
            $this->middleware('auth')->only($this->only);
        } else {
            $this->middleware('auth');
        }
    }
}
