<?php

use App\Conferencia;
use App\Empresa;
use Illuminate\Database\Seeder;

class Registros extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas=new Empresa();
        $empresas->ruc='';
        $empresas->razon_social='';
        $empresas->save();

        $conferencias=new Conferencia();
        $conferencias->conferencia='libre';
        $conferencias->save();
    }
}
