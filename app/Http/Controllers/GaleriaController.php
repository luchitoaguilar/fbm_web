<?php

namespace App\Http\Controllers;

use App\Models\Zafra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GaleriaController extends Controller
{
    public function view() {
        return view('modules.Galeria.galeria');
    }

}
