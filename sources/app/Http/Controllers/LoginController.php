<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Toastr;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required']
        ]);

        $user = UserModel::whereEmail($request->email)->first();

        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                Auth::login($user);

                Toastr::success('Login berhasil!');
                return Redirect('dashboard');
            }
            else
            {
                Toastr::error('Login gagal!');
                return \Redirect::back();
            }
        }
        else
        {
            Toastr::error('Login gagal!');
            return \Redirect::back();
        }
    }

    public function change_password()
    {
        $data = [
            'page'  => 'Change Password',
        ];
        return view('user.change_password', compact('data'));
    }

    public function update_password(Request $request)
    {
        $user = UserModel::where('id', Auth::user()->id)->first();

        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $data_update = [
                    'password' => Hash::make($request->password_update),
                ];
                
                $update = UserModel::where('id', Auth::user()->id)->update($data_update);

                Toastr::success('Password berhasil di update!');
                return Redirect('dashboard');
            }
            else
            {
                Toastr::error('Password tidak sesuai!');
                return \Redirect::back();
            }
        }
        else
        {
            Toastr::error('Password gagal update!');
            return \Redirect::back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return Redirect('login');
    }
}
