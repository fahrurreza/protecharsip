<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\RoleResource;
use App\Models\Role as RoleModel;
use Str;
use DB;

class ApiRoleController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = RoleModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = RoleResource::collection($query);

                return $category;
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function access (Request $request)
    {
        $role       = RoleModel::where('slack', $request->slack)->first();
        $role_id    = $role->id;

        $cek_access =  DB::table('menu_role')->where('role_id', $role->id)
                                            ->where('menu_id', $request->menu_id)
                                            ->get();
        if(count($cek_access) > 0){
            DB::table('menu_role')
            ->where('role_id', $role->id)
            ->where('menu_id', $request->menu_id)
            ->delete();

        }else{

            $data['role_id'] = $role->id;
            $data['menu_id'] = $request->menu_id;

            DB::table('menu_role')->insert($data);
        }
    }

    public function store (Request $request)
    {
        try {
            
            $data_insert = [
                'slack'     => Str::random(15),
                'role'      => $request->role,
            ];

            $insert = RoleModel::create($data_insert);

            if($insert)
            {
                $query = RoleModel::where('role', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $category = RoleResource::collection($query);

                return $category;
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
        $query = RoleModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'role'     => $request->role
        ];

        $query = RoleModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            $query = RoleModel::where('role', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $category = RoleResource::collection($query);

            return $category;
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
            $result=RoleModel::where('id',$request->id)->delete();
            if($request)
            {
                $query = RoleModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = RoleResource::collection($query);

                return $category;
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
