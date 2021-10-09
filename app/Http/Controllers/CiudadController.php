<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ciudad;

class CiudadController extends Controller
{
    
    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $users = ciudad::where('nombre','like',"%$input%")
            ->paginate($request->input('size'));

            return response()->json($users);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
