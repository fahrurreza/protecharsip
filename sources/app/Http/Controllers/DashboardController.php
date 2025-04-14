<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student as StudentModel;
use App\Models\Instruktur as InstrukturModel;
use App\Models\Letter as LetterModel;
use Auth;
use Toastr;
use DB;
use Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page'          => 'Dashboard',
            'siswa'         => count(StudentModel::all()),
            'instruktur'    => count(InstrukturModel::all()),
            'surat_masuk'   => count(LetterModel::where('category', 'in')->get()),
            'surat_keluar'  => count(LetterModel::where('category', 'out')->get()),
        ];
        return view('dashboard.index', compact('data'));
    }

    public function tes()
    {
        return main_menu(Auth::user()->role_id);
    }
}
