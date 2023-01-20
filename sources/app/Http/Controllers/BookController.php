<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category as CategoryModel;
use App\Models\Rak as RakModel;

class BookController extends Controller
{
    public function index()
    {
        $data = [
            'page'      => 'Buku',
            'category'  => CategoryModel::all(),
            'rak'       => rakModel::all(),
        ];
        return view('book.index', compact('data'));
    }
}
