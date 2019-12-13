<?php

namespace App\Http\Controllers;

use App\Exports\AsistentesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AsistentesExportController extends Controller
{
    public function index()
    {
        return Excel::download(new AsistentesExport, 'asistentes.xlsx');
    }
}
