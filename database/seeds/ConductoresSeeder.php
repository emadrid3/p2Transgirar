<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class ConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/ConductoresTable.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $nombre = $x[0];
            $cc = $x[1];
            $celular = $x[2];
            \DB::table('conductores')->insert(
                array(
                    'nombre' => $nombre,
                    'cedula' => $cc,
                    'celular' => $celular,
                    'estado' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }
}
