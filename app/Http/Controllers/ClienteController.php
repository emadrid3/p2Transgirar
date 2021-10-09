<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('customers.customers', ['auth' => $user]);
    }

    public function manageCustomers(){
        $customer = null;
        return view('customers.customersManage', ['customer' => $customer]);
    }

    public function editCustomers($id){

        $customer = cliente::find($id);
        //error_log($id);
        return view('customers.customersManage', ['customer' => $customer]);
    }

    public function create(Request $request)
    {
        //return view('customers.customersManage');
        try {

            $request->validate([ "nombre"=>"required", "nit"=>"required", "razonSocial"=>"required"]);
            $cliente = new cliente();
            $cliente->nombre = $request->input('nombre');
            $cliente->nit = $request->input('nit');
            $cliente->razonSocial = $request->input('razonSocial');
            $cliente->estado = $request->input('estado');
            $cliente->save();
            return response()->json(['message' => 'Cliente create succesfully']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request){

        try {
            $request->validate(["nombre"=>"required", "nit"=>"required", "razonSocial"=>"required"]);
            $customer = cliente::find($request->input('id'));
            if( !is_null($request->input('nombre')) ){
                $customer->nombre = $request->input('nombre');
            }
            if( !is_null($request->input('nit')) ){
                $customer->nit = $request->input('nit');
            }
            if( !is_null($request->input('razonSocial')) ){
                $customer->razonSocial = $request->input('razonSocial');
            }
            if( !is_null($request->input('estado')) ){
                $customer->estado = $request->input('estado');
            }
            error_log($request);

            $customer->save();

            return response()->json(['message' => 'Customer updated succesfully']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(Request $request){
        try {
            $customer = cliente::find($request->input('id'));
            $customer->delete();

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function list(Request $request){
        try {
            $listCustomer = cliente::orderBy('created_at', 'desc')->paginate($request->input('size'));
            return response()->json($listCustomer);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $customer = cliente::where('nombre','like',"%$input%")
            ->orWhere('nit','like',"%$input%")
            ->orWhere('razonSocial','like',"%$input%")
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('size'));

            return response()->json($customer);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function search(Request $request){
    
        try {

            $dataToSearch = $request->input('search');
            $size = $request->input('size');

            $response = cliente::where('nombre', 'like', '%'.$dataToSearch.'%')
            ->orWhere('nit', 'like', '%'.$dataToSearch.'%')
            ->orWhere('razonSocial', 'like', '%'.$dataToSearch.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($size);
            return response()->json($response);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
