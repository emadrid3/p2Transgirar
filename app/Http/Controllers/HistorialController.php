<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\historial;

class HistorialController extends Controller
{
    public function index()
    {
        return view('histories.histories');
    }
    public function list(Request $request){
        try {
            $listHistory = historial::orderBy('created_at', 'desc')->paginate($request->input('size'));
            return response()->json($listHistory);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function search(Request $request){
    
        try {

            $dataToSearch = $request->input('search');
            $size = $request->input('size');

            $response = historial::where('placa', 'like', '%'.$dataToSearch.'%')
            ->orWhere('tipoVehiculo', 'like', '%'.$dataToSearch.'%')
            ->orWhere('tipo', 'like', '%'.$dataToSearch.'%')
            ->orWhere('conductor', 'like', '%'.$dataToSearch.'%')
            ->orWhere('origen', 'like', '%'.$dataToSearch.'%')
            ->orWhere('destino', 'like', '%'.$dataToSearch.'%')
            ->orWhere('cliente', 'like', '%'.$dataToSearch.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($size);
            return response()->json($response);
        } catch (\Exception $e) {
           throw $e;
        }

    }
}
