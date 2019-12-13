<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function search()
    {
        $data=Empresa::select('id_empresa', 'razon_social')
        ->get();
        return json_encode($data);
    }
    public function nueva_empresa(Request $request)
    {
        $empresa=Empresa::create($request->all());
        $data=[
            'id_empresa'=>$empresa->id,
            'razon_social'=>$request->input('razon_social')
        ];
        return json_encode($data);

    }
}
