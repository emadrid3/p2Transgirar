<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class CargasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/CargaTable.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $tipoCarga = $x[1];
            \DB::table('cargas')->insert(
                array(
                    'id' => $id,
                    'tipoCarga' => $tipoCarga,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }
}
