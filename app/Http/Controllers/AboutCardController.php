<?php

namespace App\Http\Controllers;

use App\AboutCard;
use Illuminate\Http\Request;

class AboutCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AboutCard::all();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AboutCard  $aboutCard
     * @return \Illuminate\Http\Response
     */
    public function show(AboutCard $aboutCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AboutCard  $aboutCard
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutCard $aboutCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AboutCard  $aboutCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutCard $aboutCard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AboutCard  $aboutCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutCard $aboutCard)
    {
        //
    }
}
