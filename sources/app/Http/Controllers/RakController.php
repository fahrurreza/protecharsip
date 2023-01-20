<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Rak'
        ];
        return view('rak.index', compact('data'));
    }
}
