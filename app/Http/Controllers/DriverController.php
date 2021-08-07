<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Driver::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver = new Driver();
        $driver->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver $conductor
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $conductor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver $conductor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $conductore)
    {
        $conductore->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver $conductor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $conductore)
    {
        $conductore->delete();
    }


    public function listDriver()
    {
        return view('conductores');
    }
}
