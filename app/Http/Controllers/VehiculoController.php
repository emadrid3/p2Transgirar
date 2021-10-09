<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\vehiculo;


class VehiculoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('vehicles.vehicles', ['auth' => $user]);
    }
    public function manageVehicles()
    {
        $vehicle = null;
        return view('vehicles.vehiclesManage', ['vehicle' => $vehicle]);
    }
    public function update(Request $request){
        try {
            
            $request->validate(["placa"=>"required", "tipo"=>"required" ]);
            $vehicle = vehiculo::find($request->input('id'));
            if( !is_null($request->input('placa')) ){
                $vehicle->placa = $request->input('placa');
            }
            if( !is_null($request->input('ciudad')) ){
                $vehicle->ciudad = $request->input('ciudad');
            }
            if( !is_null($request->input('tipo')) ){
                $vehicle->tipo = $request->input('tipo');
            }
            if( !is_null($request->input('conductor')) ){
                $vehicle->conductor = $request->input('conductor');
            }
            if( !is_null($request->input('estado')) ){
                $vehicle->estado = $request->input('estado');
            }
            $vehicle->save();
            return response()->json(['message' => 'Vehiculo actualizado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }
    
    public function list(Request $request){
        try {
            $listVehicles = vehiculo::with('driver')->orderBy('created_at', 'desc')->paginate($request->input('size'));
            return response()->json($listVehicles);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function editVehicles($id)
    {
        $vehicle = vehiculo::with('driver')->find($id);
        return view('vehicles.vehiclesManage', ['vehicle' => $vehicle]);
    }

    public function delete(Request $request){
        try {
            $vehicle = vehiculo::find($request->input('id'));
            $vehicle->delete();
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function create(Request $request)
    {
        try {
            $vehicle = new vehiculo();
            $vehicle->placa = $request->input('plate');
            $vehicle->ciudad = $request->input('city');
            $vehicle->tipo = $request->input('type');
            $vehicle->conductor = $request->input('driver');
            $vehicle->estado = $request->input('estado');
            $vehicle->save();

            return response()->json(['message' => 'Vehiculo creado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $users = vehiculo::with('driver')
            ->where('placa','like',"%$input%")
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('size'));

            return response()->json($users);
        } catch (\Exception $e) {
           throw $e;
        }
    }
    public function search(Request $request){
        
        try {

            $dataToSearch = $request->input('search');
            $size = $request->input('size');

            $response = vehiculo::with('driver')
            ->whereHas('driver', function ($query) use ($dataToSearch) { $query->where('nombre', 'like', '%'.$dataToSearch.'%');})
            ->orWhere('placa', 'like', '%'.$dataToSearch.'%')
            ->orWhere('ciudad', 'like', '%'.$dataToSearch.'%')
            ->orWhere('tipo', 'like', '%'.$dataToSearch.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($size);
            return response()->json($response);
        
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
