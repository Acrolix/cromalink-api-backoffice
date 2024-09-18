<?php

namespace App\Http\Controllers;

use App\Models\SocialEvent;
use App\Http\Requests\StoreSocialEventRequest;
use App\Http\Requests\UpdateSocialEventRequest;

class SocialEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSocialEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialEvent  $socialEvent
     * @return \Illuminate\Http\Response
     */
    public function show(SocialEvent $socialEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialEvent  $socialEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialEvent $socialEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSocialEventRequest  $request
     * @param  \App\Models\SocialEvent  $socialEvent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialEventRequest $request, SocialEvent $socialEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialEvent  $socialEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialEvent $socialEvent)
    {
        //
    }
}
