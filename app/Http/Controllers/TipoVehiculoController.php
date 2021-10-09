<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tipo_vehiculo;

class TipoVehiculoController extends Controller
{
    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $type = tipo_vehiculo::where('tipo','like',"%$input%")
            ->paginate($request->input('size'));

            return response()->json($type);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
