<?php

namespace App\Exports;

use App\Asistente;
use Maatwebsite\Excel\Concerns\FromCollection;

class AsistentesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $Asistentes=Asistente::join('empresas','empresas.id_empresa', '=', 'asistentes.id_empresa')
        ->select('asistentes.dni','asistentes.apellidos','asistentes.nombre','asistentes.correo','asistentes.celular','empresas.razon_social')
        ->get();
        return $Asistentes;
    }
}
