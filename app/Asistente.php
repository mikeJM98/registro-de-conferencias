<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    //
    protected $fillable=['id_conferencia','dni','nombre', 'apellidos',  'correo','celular', 'id_empresa'];
}
