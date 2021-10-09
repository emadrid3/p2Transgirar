<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\factura;
use App\logistica;

class FacturaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('invoices.invoice', ['auth' => $user]);
    }

    public function delete(Request $request){
        try {
            $invoice = factura::find($request->input('id'));
            $logistic = logistica::find($invoice->idLogistica);
            $logistic->estado = "en proceso";
            $logistic->save();
            $invoice->delete();

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function list(Request $request){
        try {
            $listInvoice = factura::orderBy('created_at', 'desc')->paginate($request->input('size'));
            return response()->json($listInvoice);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request){

        try {
            $request->validate(["valorFactura"=>"required", "numeroFactura"=>"required", "numeroOrden"=>"required"]);
            $invoice = factura::find($request->input('id'));
            if( !is_null($request->input('valorFactura')) ){
                $invoice->valorFactura = $request->input('valorFactura');
            }
            if( !is_null($request->input('numeroFactura')) ){
                $invoice->numeroFactura = $request->input('numeroFactura');
            }
            if( !is_null($request->input('numeroOrden')) ){
                $invoice->numeroOrden = $request->input('numeroOrden');
            }
            if( !is_null($request->input('valorAdicional')) ){
                $invoice->valorAdicional = $request->input('valorAdicional');
            }
            if( !is_null($request->input('flete')) ){
                $invoice->flete = $request->input('flete');
            }
            if( !is_null($request->input('anticipo')) ){
                $invoice->anticipo = $request->input('anticipo');
            }
            if( !is_null($request->input('porcentaje')) ){
                $invoice->porcentaje = $request->input('porcentaje');
            }
            if( !is_null($request->input('estado')) ){
                $invoice->estado = $request->input('estado');
            }
            error_log($request);

            $invoice->save();

            return response()->json(['message' => 'Invoice updated succesfully']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function searchByParams(Request $request)
    {
        try {
            $size = $request->input('size');
            $input = $request->input('input');

            $invoice = factura::where('numeroFactura','like',"%$input%")
            ->orWhere('numeroOrden','like',"%$input%")
            ->orWhere('numero_factura_cliente','like',"%$input%")
            ->orderBy('created_at', 'desc')
            ->paginate($request->input('size'));

            return response()->json($invoice);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function changeStatus(Request $request){
        try {
            $invoice = factura::find($request->input('id'));
            $invoice->estado = $request->input('estado');
            $invoice->save();

            return response()->json('OK');
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function search(Request $request){

        try {

            $dataToSearch = $request->input('search');
            $size = $request->input('size');

            $response = factura::where('numeroFactura', 'like', '%'.$dataToSearch.'%')
            ->orWhere('numeroOrden', 'like', '%'.$dataToSearch.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($size);
            return response()->json($response);
        } catch (\Exception $e) {
           throw $e;
        }

    }
}
