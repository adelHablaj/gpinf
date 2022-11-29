<?php

namespace App\Http\Controllers;

use App\Models\Scolarite;
use App\Http\Requests\StoreScolariteRequest;
use App\Http\Requests\UpdateScolariteRequest;

class ScolariteController extends Controller
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
     * @param  \App\Http\Requests\StoreScolariteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScolariteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function show(Scolarite $scolarite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function edit(Scolarite $scolarite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScolariteRequest  $request
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScolariteRequest $request, Scolarite $scolarite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scolarite $scolarite)
    {
        //
    }
}
