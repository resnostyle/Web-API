<?php

namespace App\Http\Controllers;

use App\Invite;
use Illuminate\Http\Request;

class InvitesController extends SecureController {

    protected $only = ['store'];

    public function index() {

        $invites = Invite::free()->get();

        return view('invite.index', compact('invites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Invite $invite
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Invite $invite)
    {
        return view('invite.register', compact('invite'));
    }
}
