<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\UserResource;
use App\Models\User as UserModel;
use Hash;
use Str;
use Auth;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = UserModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->where('id', '!=', 1)
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $user = UserResource::collection($query);

                return $user;
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function store (Request $request)
    {
        try {
            
            $data_insert = [
                'slack'             => Str::random(15),
                'nama_lengkap'      => $request->namauser,
                'username'          => $request->username,
                'email'             => $request->email,
                'password'          => Hash::make('12345678'),
                'status'            => $request->status,
                'user_id'           => 1,
                'role_id'           => $request->role_id,
                'created_at'        => now(),
            ];

            $insert = UserModel::create($data_insert);

            if($insert)
            {
                $query = UserModel::where('username', 'LIKE', '%' . $request->keyword . '%')
                                    ->where('id', '!=', 1)
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $user = UserResource::collection($query);

                return $user;
            } 
            else 
            {
                return response([
                    "message" => "failed insert data",
                    "status_code" => 500
                 ], 500);
            }
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function show(Request $request)
    {
        $query = UserModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'nama_lengkap'      => $request->namauser,
            'username'          => $request->username,
            'email'             => $request->email,
            'status'            => $request->status,
            'user_id'           => Auth::user()->id,
            'role_id'           => $request->role_id,
            'updated_at'        => now(),
        ];

        $query = UserModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            $query = UserModel::where('username', 'LIKE', '%' . $request->keyword . '%')
                                ->where('id', '!=', 1)
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $user = UserResource::collection($query);

            return $user;
        } 
        else 
        {
            return response([
                "message" => "failed update data",
                "status_code" => 500
             ], 500);
        }
    }

    public function delete(Request $request)
    {
        try 
        {
            $result=UserModel::where('id',$request->id)->delete();
            if($request)
            {
                $query = UserModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->where('id', '!=', 1)
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $user = UserResource::collection($query);

                return $user;
            }
            else
            {
                return response([
                    "message" => "failed insert data",
                    "status_code" => 500
                 ], 500);
            }
        }
        catch(Exception $e)
        {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }
}
