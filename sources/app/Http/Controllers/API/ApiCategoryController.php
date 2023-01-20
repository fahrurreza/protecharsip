<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\CategoryResource;
use App\Models\Category as CategoryModel;

class ApiCategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = CategoryModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = CategoryResource::collection($query);

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

    public function store (Request $request)
    {
        try {
            
            $data_insert = [
                'category_name'     => $request->category_name,
                'deskripsi'          => $request->deskripsi,
                'status'        => $request->status
            ];

            $insert = CategoryModel::create($data_insert);

            if($insert)
            {
                $query = CategoryModel::where('category_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $category = CategoryResource::collection($query);

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
        $query = CategoryModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'category_name'     => $request->category_name,
            'deskripsi'          => $request->deskripsi,
            'status'        => $request->status
        ];

        $query = CategoryModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            $query = CategoryModel::where('category_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $category = CategoryResource::collection($query);

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
            $result=CategoryModel::where('id',$request->id)->delete();
            if($request)
            {
                $query = CategoryModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = CategoryResource::collection($query);

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
