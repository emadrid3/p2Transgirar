<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\carga;

class CargaController extends Controller
{
    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $charge = carga::where('tipoCarga','like',"%$input%")
            ->paginate($request->input('size'));

            return response()->json($charge);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
