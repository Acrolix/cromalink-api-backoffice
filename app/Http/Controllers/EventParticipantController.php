<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventParicipantsRequest;
use App\Http\Requests\UpdateEventParicipantsRequest;
use App\Models\EventParticipant;

class EventParticipantController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventParicipantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventParicipantsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventParicipants  $eventParicipants
     * @return \Illuminate\Http\Response
     */
    public function show(EventParticipant $eventParicipants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventParicipantsRequest  $request
     * @param  \App\Models\EventParicipants  $eventParicipants
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventParicipantsRequest $request, EventParticipant $eventParicipants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventParicipants  $eventParicipants
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventParticipant $eventParicipants)
    {
        //
    }
}
