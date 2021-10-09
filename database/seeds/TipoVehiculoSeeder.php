<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/TipoVehiculoTable.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $tipo = $x[1];
            $idVehiculo = $x[2];
            $idConductor = $x[3];
            \DB::table('tipo_vehiculos')->insert(
                array(
                    'id' => $id,
                    'tipo' => $tipo,
                    'idVehiculo' => $idVehiculo,
                    'idConductor' => $idConductor,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }
}
