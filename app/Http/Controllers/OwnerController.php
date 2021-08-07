<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Owner::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $owner = new Owner();
        $owner->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $Owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $propietario)
    {
        $propietario->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $propietario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $propietario)
    {
        $propietario->delete();
    }

    public function getOwners(Request $request)
    {
        if ($request->ajax()) {
            $Owner = Owner::with('vehicle')->get()->map(function ($owner) {
                return [
                    "owner" => [
                        "id" => $owner->id,
                        "text" => $owner->first_name. $owner->second_name
                    ]
                ];
            });
            return response()->json($Owner);
        }
    }

    public function listOwner()
    {
        return view('propietarios');
    }
}
