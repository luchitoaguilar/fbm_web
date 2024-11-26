<?php

namespace App\Http\Controllers;

use App\Models\Zafra;
use Illuminate\Http\Request;

class AcercaController extends Controller
{
    public function mision() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');
        return view('modules.QuienesSomos.mision', compact('zafra'));
    }

    public function vision() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');
        return view('modules.QuienesSomos.vision',compact('zafra'));
    }

    public function objetivos() {
        $zafra = Zafra::where('estado', 1)
        ->sum('peso_neto');
        return view('modules.QuienesSomos.objetivos',compact('zafra'));
    }
}
