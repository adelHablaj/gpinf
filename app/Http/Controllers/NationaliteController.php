<?php

namespace App\Http\Controllers;

use App\Models\Nationalite;
use App\Http\Requests\StoreNationaliteRequest;
use App\Http\Requests\UpdateNationaliteRequest;

class NationaliteController extends Controller
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
     * @param  \App\Http\Requests\StoreNationaliteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNationaliteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nationalite  $nationalite
     * @return \Illuminate\Http\Response
     */
    public function show(Nationalite $nationalite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nationalite  $nationalite
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationalite $nationalite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNationaliteRequest  $request
     * @param  \App\Models\Nationalite  $nationalite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNationaliteRequest $request, Nationalite $nationalite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nationalite  $nationalite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationalite $nationalite)
    {
        //
    }
}
