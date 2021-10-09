<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/VehiculoTable.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $placa = $x[1];
            $tipo = $x[2];
            \DB::table('vehiculos')->insert(
                array(
                    'id' => $id,
                    'placa' => $placa,
                    'ciudad' => NULL,
                    'tipo' => $tipo,
                    'conductor' => NULL,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }
}
