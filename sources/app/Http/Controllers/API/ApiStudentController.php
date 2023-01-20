<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\StudentResource;
use App\Models\Student as StudentModel;

class ApiStudentController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = StudentModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $student = StudentResource::collection($query);

                return $student;
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
                'user_id'           => 1,
                'nama_siswa'        => $request->nama_siswa,
                'nis'               => $request->nis,
                'alamat'            => $request->alamat,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'tahun_angkatan'    => $request->tahun_angkatan,
                'status'            => $request->status,
                'created_at'        => now(),
            ];

            $insert = StudentModel::create($data_insert);

            if($insert)
            {
                $query = StudentModel::where('nama_siswa', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $student = StudentResource::collection($query);

                return $student;
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
        $query = StudentModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'nama_siswa'        => $request->nama_siswa,
            'nis'               => $request->nis,
            'alamat'            => $request->alamat,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'tahun_angkatan'    => $request->tahun_angkatan,
            'status'            => $request->status,
        ];

        $query = StudentModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            $query = StudentModel::where('nama_siswa', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $student = StudentResource::collection($query);

            return $student;
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
            $result=StudentModel::where('id',$request->id)->delete();
            if($request)
            {
                $query = StudentModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $student = StudentResource::collection($query);

                return $student;
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
