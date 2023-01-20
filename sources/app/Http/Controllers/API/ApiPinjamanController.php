<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\PinjamanResource;
use \App\Http\Resources\StudentResource;
use App\Models\Pinjaman as PinjamanModel;
use App\Models\Student as StudentModel;
use DB;

class ApiPinjamanController extends Controller
{
    public function index(Request $request)
    {
        $data = StudentModel::with('pinjaman')
                                ->where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                );

        return StudentResource::collection($data);
    }

    public function kembalian(Request $request)
    {
        $data = StudentModel::with('kembalian')
                                ->where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                );

        return StudentResource::collection($data);
    }

    public function update(Request $request)
    {
        $data_update = [
            'tanggal_kembali' => now(),
            'status'     => 0
        ];

        $query = PinjamanModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            $data = StudentModel::with('pinjaman')
                                ->where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                );

            return StudentResource::collection($data);
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
            $result=PinjamanModel::where('id',$request->id)->delete();
            if($request)
            {
                $data = StudentModel::with('pinjaman')
                                ->where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                );

                return StudentResource::collection($data);
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
