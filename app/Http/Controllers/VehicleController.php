<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->per_page;
        return  Vehicle::paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoRequest $request)
    {
        $vehiculo = new Vehicle();
        $vehiculo->create($request->all());
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
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculoRequest $request, Vehicle $vehiculo)
    {
        $vehiculo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehiculo)
    {
        $vehiculo->delete();
    }



    public function getVehicles(Request $request)
    {
        if ($request->ajax()) {
            $Drivers = Vehicle::get()->map(function ($vehicle) {
                return [
                    "vehicle" => [
                        "id" => $vehicle->id,
                        "text" => $vehicle->plaque
                    ]
                ];
            });
            return response()->json($Drivers);
        }
    }

    //Funcion para obtener el detalle de ese vehiculo, obtener el nombre del conductor y propietario
    public function getDetailVehicle($id)
    {
       $vehicle = Vehicle::with('drivers', 'owner')->where('id', $id)->first();
        return response()->json($vehicle);
    }
}
