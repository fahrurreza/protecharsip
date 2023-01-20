<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\Resources\BookResource;
use App\Models\Book as BookModel;
use App\Models\Stock as StockModel;
use DB;

class ApiBookController extends Controller
{
    public function index(Request $request)
    {
        try {
                $query = BookModel::with(['stock', 'rak', 'category'])
                                    ->where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = BookResource::collection($query);

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
            DB::beginTransaction();
            try {
                $data_insert = [
                    'category_id'   => $request->category_id,
                    'rak_id'        => $request->rak_id,
                    'book_name'     => $request->book_name,
                    'pengarang'     => $request->pengarang,
                    'penerbit'      => $request->penerbit,
                    'tahun_terbit'  => $request->tahun_terbit,
                    'isbn'          => $request->isbn,
                    'jumlah'        => $request->jumlah,
                    'deskripsi'     => $request->deskripsi,
                    'status'        => $request->status
                ];

                $insert = BookModel::create($data_insert)->id;

                $update_stock = [
                    'stock' => $request->jumlah
                ];
        
                $query_stock = StockModel::where('book_id', $insert)->update($update_stock);

                DB::commit();
                
                $query = BookModel::where('book_name', 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = 10, $columns = ['*'], 'page', 1
                                    );
                $category = BookResource::collection($query);

                return $category;
            } catch (\Exception $e) {
                DB::rollback();
    
                return response([
                    "message" => "failed update data",
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
        $query = BookModel::where('id', '=', $request->id)->first();

        return $query;
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $update_buku = [
                'category_id'   => $request->category_id,
                'rak_id'        => $request->rak_id,
                'book_name'     => $request->book_name,
                'pengarang'     => $request->pengarang,
                'penerbit'      => $request->penerbit,
                'tahun_terbit'  => $request->tahun_terbit,
                'isbn'          => $request->isbn,
                'deskripsi'     => $request->deskripsi,
                'status'        => $request->status
            ];
    
            $update_stock = [
                'stock' => $request->jumlah
            ];
    
            $query_buku = BookModel::where('id', $request->id)->update($update_buku);
            $query_stock = StockModel::where('book_id', $request->id)->update($update_stock);

            DB::commit();

            $query_get = BookModel::where('book_name', 'LIKE', '%' . $request->keyword . '%')
                                ->paginate(
                                    $perPage = 10, $columns = ['*'], 'page', 1
                                );
            $books = BookResource::collection($query_get);

            return $books;

        } catch (\Exception $e) {
            DB::rollback();

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
            $result=BookModel::where('id',$request->id)->delete();
            if($request)
            {
                $query = BookModel::where($request->column, 'LIKE', '%' . $request->keyword . '%')
                                    ->paginate(
                                        $perPage = $request->perPage, $columns = ['*'], 'page', $request->pageSelect
                                    );
                $category = BookResource::collection($query);

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
