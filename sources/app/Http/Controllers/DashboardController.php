<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\PinjamanResource;
use \App\Http\Resources\StudentResource;
use App\Models\Pinjaman as PinjamanModel;
use App\Models\Book as BookModel;
use App\Models\Student as StudentModel;
use App\Models\Menu as MenuModel;
use App\Models\MenuRole as MenuRoleModel;
use App\Models\User as UserModel;
use Auth;
use Toastr;
use DB;
use Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page'      => 'Dashboard',
        ];
        return view('dashboard.index', compact('data'));
    }

    public function tes()
    {
        return main_menu(Auth::user()->role_id);
    }
}
