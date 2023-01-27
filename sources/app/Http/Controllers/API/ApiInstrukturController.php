<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\InstrukturResource;
use App\Models\Instruktur as InstrukturModel;

class ApiInstrukturController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = InstrukturModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $instruktur = InstrukturResource::collection($query);

                return $instruktur;
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
                'nama_lengkap'      => $request->nama_lengkap,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'sex'               => $request->sex,
                'bidang_keahlian'   => $request->keahlian,
                'nomor_sk'          => $request->nomor_sk,
                'status'            => $request->status
            ];

            $insert = InstrukturModel::create($data_insert);

            if($insert)
            {
                $query = InstrukturModel::where('nama_lengkap', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $instruktur = InstrukturResource::collection($query);

                return $instruktur;
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
        $query = InstrukturModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        $data_update = [
            'nama_lengkap'      => $request->nama_lengkap,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'sex'               => $request->sex,
            'bidang_keahlian'   => $request->keahlian,
            'nomor_sk'          => $request->nomor_sk,
            'status'            => $request->status
        ];

        $query = InstrukturModel::where('id', $request->id)->update($data_update);

        if($query)
        {
            $query = InstrukturModel::where('nama_lengkap', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $instruktur = InstrukturResource::collection($query);

            return $instruktur;
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
            $result=InstrukturModel::where('id',$request->id)->delete();
            if($request)
            {
                $query = InstrukturModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $instruktur = InstrukturResource::collection($query);

                return $instruktur;
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
