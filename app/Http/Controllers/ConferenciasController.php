<?php

namespace App\Http\Controllers;

use App\Conferencia;
use Illuminate\Http\Request;

class ConferenciasController extends Controller
{
    //
    public function show(){
        $conferencias=Conferencia::all();
        if ($conferencias) {
            $data=array();
            foreach ($conferencias as $conferencia) {
                $tem=array(
                    'id_conferencia' => $conferencia['id_conferencia'],
                    'conferencia' => $conferencia['conferencia'],
                );
                $data[]=$tem;
            }
            return json_encode(array_reverse($data));
        }
        return false;
    }
}
