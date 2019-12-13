<?php

namespace App\Http\Controllers;

use App\Asistente;
use App\Empresa;
use Illuminate\Http\Request;

class AsistentesController extends Controller
{
    public function registra(Request $request)
    {
        #dd($request->all());
        $asistente=Asistente::create($request->all());
        return json_encode(['id_asistente'=>$asistente->id]);
    }
    public function show()
    {
        $Asistentes=Asistente::join('empresas','empresas.id_empresa', '=', 'asistentes.id_empresa')
        ->select('asistentes.dni','asistentes.apellidos','asistentes.nombre','asistentes.correo','asistentes.celular','empresas.razon_social')
        ->get();
        if ($Asistentes) {
            $data=array();
            foreach ($Asistentes as $Asistente) {
                $tem=array(
                    'dni' => $Asistente['dni'],
                    'apellidos' => $Asistente['apellidos'],
                    'nombre' => $Asistente['nombre'],
                    'correo' => $Asistente['correo'],
                    'celular' => $Asistente['celular'],
                    'empresa' => $Asistente['razon_social']
                );
                $data[]=$tem;
            }
            return json_encode(array_reverse($data));
        }
        return false;
        
    }
    public function buscar_asistente(Request $request)
    {
        $id=(int) $request->input('id_asistente');
        $Asistente=Asistente::join('empresas','empresas.id_empresa', '=', 'asistentes.id_empresa')
        ->select('asistentes.dni','asistentes.apellidos','asistentes.nombre','asistentes.correo','asistentes.celular','empresas.razon_social')
        ->where('id_asistente','=', $id)->firstOrFail();
        $data=array(
            'dni' => $Asistente['dni'],
            'apellidos' => $Asistente['apellidos'],
            'nombre' => $Asistente['nombre'],
            'correo' => $Asistente['correo'],
            'celular' => $Asistente['celular'],
            'empresa' => $Asistente['razon_social']
        );
        return json_encode($data);

    }
    public function virifica_dni(Request $request)
    {
        $dni=$request->input('dni');
        $result=Asistente::where('dni','=',"$dni")->first();
        #dd($result);
        if($result===null){
            return ['estado'=>false];
        }else{
            return ['estado'=>true];
        }
    }
}
