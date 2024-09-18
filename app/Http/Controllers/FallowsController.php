<?php

namespace App\Http\Controllers;

use App\Models\Fallows;
use App\Http\Requests\StoreFallowsRequest;
use App\Http\Requests\UpdateFallowsRequest;

class FallowsController extends Controller
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
     * @param  \App\Http\Requests\StoreFallowsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFallowsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fallows  $fallows
     * @return \Illuminate\Http\Response
     */
    public function show(Fallows $fallows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fallows  $fallows
     * @return \Illuminate\Http\Response
     */
    public function edit(Fallows $fallows)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFallowsRequest  $request
     * @param  \App\Models\Fallows  $fallows
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFallowsRequest $request, Fallows $fallows)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fallows  $fallows
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fallows $fallows)
    {
        //
    }
}
