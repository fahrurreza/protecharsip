<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role as RoleModel;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'User',
            'role'  => RoleModel::where('id', '!=', 1)->get(),
        ];
        return view('user.index', compact('data'));
    }
}
