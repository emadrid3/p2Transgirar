<?php

namespace App\Http\Controllers;
use App\logistica;
use App\factura;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $page = '1';
        return view('logistic.logistic', ['auth' => $user, 'page' => $page]);
    }
    public function indexPage($page)
    {
        $user = Auth::user();
        return view('logistic.logistic', ['auth' => $user, 'page' => $page]);
    }
    public function manageLogistic()
    {
        $logistica = null;
        return view('logistic.logisticManage', ['logistica' => $logistica]);
    }

    public function editLogistic($page,$id)
    {
        $logistica = logistica::with('encargado.user')->with('conductor')->with('vehiculo')->with('cliente')->with('carga')->with('tipo')->find($id);
        return view('logistic.logisticManage', ['logistica' => $logistica, 'page' => $page]);
    }

    public function create(Request $request)
    {
        try {

            if($request->input('id') != NULL){
                $logistica = logistica::find($request->input('id'));
            }else{
                $logistica = new logistica();
                $logistica->numero_factura = NULL;
                $logistica->numero_orden = NULL;
                $logistica->numero_factura_cliente = NULL;
                $logistica->encargado_id = NULL;
                $logistica->fecha = NULL;
                $logistica->vehiculo_id = NULL;
                $logistica->valor_viaje = 0;
                $logistica->flete = 0;
                $logistica->anticipo = 0;
                $logistica->descuento = 0;
                $logistica->conductor_id = NULL;
                $logistica->origen = NULL;
                $logistica->destino = NULL;
                $logistica->trayecto = NULL;
                $logistica->carga_id = NULL;
                $logistica->tipo_id = NULL;
                $logistica->cliente_id = NULL;
                $logistica->extra = NULL;
                $logistica->extra_total = 0;
                $logistica->descripcion = NULL;
                $logistica->factura_total = 0;

                $logistica->estado = "en proceso";
            }

            $sum = 0;
            


            $logistica->numero_factura = $request->input('bill_number');
            $logistica->numero_orden = $request->input('order_number');
            $logistica->numero_factura_cliente = $request->input('customer_number');


            if($request->input('user') != NULL){
                $logistica->encargado_id = $request->input('user')['id'];
            }

            if($request->input('date') != NULL || $request->input('date') != ""){
                $logistica->fecha = Carbon::createFromFormat('Y-m-d',$request->input('date'));
            }

            if($request->input('vehicle') != NULL){
                $logistica->vehiculo_id = $request->input('vehicle')['id'];
            }

            $logistica->valor_viaje = $request->input('travel_total');


            $logistica->flete = $request->input('freight');


            $logistica->anticipo = $request->input('advance');


            $logistica->descuento = $request->input('discount');


            if($request->input('driver') != NULL){
                $logistica->conductor_id = $request->input('driver')['id'];
            }

            if(count($request->input('travel')) > 0 && $request->input('travel')[0] != NULL){
                
                $logistica->origen = $request->input('travel')[0]['id'];

                if(count($request->input('travel')) > 1){
                    $logistica->destino = $request->input('travel')[count($request->input('travel'))-1]['id'];
                }else{
                    $logistica->destino = NULL;
                }

                $logistica->trayecto = json_encode($request->input('travel'));
            }else{
                $logistica->origen = NULL;
                $logistica->trayecto = NULL;
                $logistica->destino = NULL;
            }

            if($request->input('charge') != NULL){
                $logistica->carga_id = $request->input('charge');
            }

            if($request->input('type') != NULL){
                $logistica->tipo_id = $request->input('type');
            }

            if($request->input('customer') != NULL){
                $logistica->cliente_id = $request->input('customer')['id'];
            }

            if(count($request->input('extra')) > 0){
                $logistica->extra = json_encode($request->input('extra'));

                foreach ($request->input('extra') as $value) {
                    $sum += $value['value'];
                }

                $logistica->extra_total = $sum;
            }

            if($request->input('description') != NULL){
                $logistica->descripcion = $request->input('description');
            }

            $logistica->factura_total = ($sum + $request->input('travel_total'));
            
            $logistica->save();

            return response()->json(['message' => 'Vehiculo creado satisfactoriamente']);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function delete(Request $request){
        try {
            $logistic = logistica::find($request->input('id'));
            $logistic->delete();
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function list(Request $request){
        try {
            $listLogistic = logistica::with('encargado.user')->with('conductor')->with('vehiculo')->with('cliente')->with('carga')->with('tipo')->with('origen_obj')->with('destino_obj')->orderBy('created_at', 'desc')->paginate($request->input('size'));
            return response()->json($listLogistic);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function changeStatus(Request $request){
        try {
            DB::beginTransaction();
            $logistic = logistica::find($request->input('id'));
            $logistic->estado = $request->input('estado');
            $logistic->save();

            if($request->input('estado') == 'liquidado'){
                $factura = new factura();
                $factura->idLogistica = $logistic->id;
                $factura->valorFactura = $logistic->factura_total;
                $factura->numeroFactura = $logistic->numero_factura;
                $factura->numeroOrden = $logistic->numero_orden;
                $factura->valorAdicional = $logistic->extra_total;
                $factura->flete = $logistic->flete;
                $factura->anticipo = $logistic->anticipo;
                $factura->porcentaje = $logistic->descuento;
                $factura->idVehiculo = $logistic->vehiculo_id;
                $factura->idCliente = $logistic->cliente_id;
                $factura->estado = "pendiente de pago";
                $factura->save();
            }

            DB::commit();
            return response()->json('OK');
        } catch (\Exception $e) {
            DB::rollback();
           throw $e;
        }
    }

    public function search(Request $request){
    
        try {

            $dataToSearch = $request->input('search');
            $size = $request->input('size');

            $response = logistica::with('encargado.user')
            ->with('conductor')
            ->with('vehiculo')
            ->with('cliente')
            ->with('carga')
            ->with('tipo')
            ->with('origen_obj')
            ->with('destino_obj')
            ->whereHas('encargado.user', function ($query) use ($dataToSearch) { $query->where('name', 'like', '%'.$dataToSearch.'%');})
            ->orWhereHas('vehiculo', function ($query) use ($dataToSearch) { $query->where('placa', 'like', '%'.$dataToSearch.'%');})
            ->orWhereHas('conductor', function ($query) use ($dataToSearch) { $query->where('nombre', 'like', '%'.$dataToSearch.'%');})
            ->orWhereHas('origen_obj', function ($query) use ($dataToSearch) { $query->where('nombre', 'like', '%'.$dataToSearch.'%');})
            ->orWhereHas('destino_obj', function ($query) use ($dataToSearch) { $query->where('nombre', 'like', '%'.$dataToSearch.'%');})
            ->orWhereHas('cliente', function ($query) use ($dataToSearch) { $query->where('razonSocial', 'like', '%'.$dataToSearch.'%');})
            ->orWhere('numero_factura', 'like', '%'.$dataToSearch.'%')
            ->orWhere('numero_orden', 'like', '%'.$dataToSearch.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($size);

            return response()->json($response);
        } catch (\Exception $e) {
           throw $e;
        }
    }
}
