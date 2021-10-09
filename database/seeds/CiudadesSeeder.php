<?php

use App\Http\Controllers\Controller;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Europe/Madrid');
        // Cargando el csv en memoria
        $archivo = '../transgirar/Finales seeders dataset/Ciudades.csv';
        $csv = Reader::createFromPath($archivo);
        $csv->setHeaderOffset(0);
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$out->writeln($date);
        foreach($csv as $offset => $registro){
            $impl = implode(';', $registro);
            $x = explode(';',$impl);
            $id = $x[0];
            $nombre = str_replace('�','Ñ',$x[1]);

            \DB::table('cities')->insert(
                array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                )
            );
        }
    }
}