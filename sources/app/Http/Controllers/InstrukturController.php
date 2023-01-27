<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Instruktur'
        ];
        return view('instruktur.index', compact('data'));
    }
}
