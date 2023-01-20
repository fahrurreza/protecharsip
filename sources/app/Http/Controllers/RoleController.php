<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role as RoleModel;
use App\Models\Menu as MenuModel;
use DB;
use Toastr;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Role'
        ];
        return view('role.index', compact('data'));
    }

    public function role_menu()
    {
        $data = [
            'page'  => 'Access Role',
            'role'  => RoleModel::all()
        ];
        return view('role.role_menu', compact('data'));
    }

    public function setting_menu(Request $request)
    {
        $data = [
            'page'  => 'Setting Access',
            'menu'  => MenuModel::where('parent_id', 0)
                                ->with(['children'])
                                ->orderBy('short_order', 'ASC')
                                ->get(),
            'slack' => $request->slack,
            'role'  => RoleModel::where('slack', $request->slack)->first()
        ];

        return view('role.access_menu', compact('data'));
    }
}
