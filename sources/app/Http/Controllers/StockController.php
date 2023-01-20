<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $data = [
            'page'      => 'Stock'
        ];
        return view('stocks.index', compact('data'));
    }
}
