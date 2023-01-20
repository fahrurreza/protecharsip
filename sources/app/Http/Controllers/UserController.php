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
            'role'  => RoleModel::all(),
        ];
        return view('user.index', compact('data'));
    }
}
