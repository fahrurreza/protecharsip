<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student as StudentModel;
use App\Models\Book as BookModel;
use \App\Http\Resources\BookResource;
use App\Models\Pinjaman as PinjamanModel;
use Toastr;

class PinjamanController extends Controller
{
    public function index()
    {
        $data = [
            'page'  => 'Pinjaman',
            'student' => StudentModel::where('status', true)->get(),
            'book' => BookModel::with('stock')->where('status', true)->get(),
        ];
        return view('pinjaman.index', compact('data'));
    }

    public function kembalian()
    {
        $data = [
            'page'  => 'Buku Di Kembalikan'
        ];
        return view('pinjaman.kembalian', compact('data'));
    }

    public function store (Request $request)
    {
        $check = 0;
        for($x=1;$x<=count($request->book_id);$x++){
            $check+= PinjamanModel::where('student_id', $request->student_id)
                                    ->where('book_id', $request->book_id[$x-1])
                                    ->where('status', true)
                                    ->count();
            
        }

        if($check > 0){
            Toastr::warning('Terdapat double data pinjaman, cek data pinjaman siswa!');
            return back();
        }

        for($x=1;$x<=count($request->book_id);$x++){
            $data_insert[]= [
                'book_id'    => $request->book_id[$x-1],
                'student_id'    => $request->student_id,
                'jumlah'        => 1,
                'tanggal_dipinjam'  => now(),
                'batas_dipinjam'    => $request->batas_pinjam,
                'tanggal_kembali'   => null,
                'status'            => true,
                'user_id'           => 1,
                'created_at'        => now(),
                'updated_at'        => null
            ];
        }

        $insert = PinjamanModel::insert($data_insert);

        if($insert)
        {
            Toastr::success('Berhasil!');
            return back();
        } 
        else 
        {
            Toastr::success('Gagal!');
            return back();
        }

    }
}
