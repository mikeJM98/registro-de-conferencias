<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    public function search(Request $request){
        $search = strtoupper($request->get('empresa'));
        #$result = User::where('name', 'LIKE', '%'. $search. '%')->get();
        $result=Empresa::where('upper(razon_social)','like', "%$search%");
        return json_encode($result);
        $sql='s';
        #dd($sql);
        $result = DB::select($sql);
        $temp= array();
        foreach($result as $r => $q){
            foreach($q as $t => $w){
                $temp[]=trim($w);
            }
        }
        $temp=array_unique($temp);
        return response()->json($temp);
    }
}
