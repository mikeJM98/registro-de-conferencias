<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\reniec\reniec;

class ApiController extends Controller
{
    public function buscarDni(Request $request)
    { 
        if ($request->ajax()) {
            $dni=$request->get('dni');
            $persona = new Reniec();
            $yo = $persona->search( $dni );
            if (is_null($yo)) {
                $data=array('estado' => false);
                echo json_encode($data);
            }else{
                if( $yo->success==true )
                {
                    $data=array(
                        'dni' => $yo->result->DNI,
                        'codveri' => $yo->result->CodVerificacion,
                        'nombres' => $yo->result->Nombres,
                        'apellidos' => $yo->result->Apellidos,
                        'estado' => $yo->success
                    );
                    echo json_encode($data);
                }else{
                    $data=array('estado' => $yo->success);
                    echo json_encode($data);
                }                
            }

        }
    }

}
