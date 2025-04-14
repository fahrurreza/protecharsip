<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Letter as LetterModel;
use App\Models\Document as DocumentModel;
use Auth;
use DB;
use Str;
use Image;
use Toastr;
use PDF;

class LetterController extends Controller
{
    public function surat_masuk()
    {
        $data = [
            'page'  => 'Surat Masuk',
            'item'  => LetterModel::where('category', 'in')->get(),
        ];
        return view('letter.surat_masuk', compact('data'));
    }

    public function surat_masuk_detail($slack)
    {
        
        $data = [
            'page'  => 'Detail Surat Masuk',
            'item'  => LetterModel::with('document')->where('category', 'in')->where('slack', $slack)->first(),
        ];

        return view('letter.surat_masuk_detail', compact('data'));
    }

    public function edit_surat_masuk($slack)
    {
        
        $data = [
            'page'  => 'Edit Surat Masuk',
            'item'  => LetterModel::with('document')->where('slack', $slack)->first(),
        ];

        return view('letter.edit_surat_masuk', compact('data'));
    }

    public function document($file)
    {
        $array_file = explode('.', $file);
        $extension = end($array_file);
        
        $data = [
            'page'  => 'Dokumen Surat',
            'file'  => $file,
        ];

        if($extension == 'pdf')
        {
            return view('letter.file_pdf', compact('data'));
        }
        else
        {    
            return view('letter.file_image', compact('data'));
        }
    }

    public function create_surat_masuk(Request $request)
    {
        DB::beginTransaction();
            try
            {
                
                $data_insert = [
                    'slack'     => Str::random(25),
                    'no_agenda'     => $request->no_agenda,
                    'pengirim'      => $request->pengirim,
                    'notes'         => $request->notes,
                    'no_surat'      => $request->no_surat,
                    'tgl_surat'     => $request->tgl_surat,
                    'tgl_dikirim'   => $request->tgl_dikirim,
                    'user_id'       => Auth::user()->id,
                    'category'      => 'in',
                    'created_at'    => now()
                ];
    
                $latter_id = LetterModel::create($data_insert)->id;

                $files = [];

                foreach($request->file('document') as $file)

                {
                    $filename = Str::random(8).'.'.$file->extension();
                    $file->move('assets/document', $filename);  

                    $data_document[] = [
                        'latter_id'       => $latter_id,
                        'document'        => $filename,
                        'name'            => 'document surat masuk id:'.$latter_id
                    ];
    
                }

                DocumentModel::insert($data_document);


                DB::commit();

                Toastr::success('Arsip berhasil disimpan');
                return back();
            }
            catch(Exception $e)
            {
                DB::rollback();

                Toastr::error('Oops, Terjadi kesalahan, Arsip gagal disimpan');
                
                return back();
            }

        
        
    }

    public function surat_keluar()
    {
        $data = [
            'page'  => 'Surat Keluar',
            'item'  => LetterModel::where('category', 'out')->get(),
        ];
        return view('letter.surat_keluar', compact('data'));
    }

    public function surat_keluar_detail($slack)
    {
        
        $data = [
            'page'  => 'Detail Surat Keluar',
            'item'  => LetterModel::with('document')->where('slack', $slack)->first(),
        ];

        return view('letter.surat_keluar_detail', compact('data'));
    }

    public function edit_surat_keluar($slack)
    {
        $data = [
            'page'  => 'Edit Surat Keluar',
            'item'  => LetterModel::with('document')->where('slack', $slack)->first(),
        ];

        return view('letter.edit_surat_keluar', compact('data'));
    }

    public function create_surat_keluar(Request $request)
    {
        DB::beginTransaction();
            try
            {
                
                $data_insert = [
                    'slack'     => Str::random(25),
                    'no_agenda'     => $request->no_agenda,
                    'pengirim'      => $request->pengirim,
                    'notes'         => $request->notes,
                    'no_surat'      => $request->no_surat,
                    'tgl_surat'     => $request->tgl_surat,
                    'tgl_dikirim'   => $request->tgl_surat,
                    'user_id'       => Auth::user()->id,
                    'category'      => 'out',
                    'created_at'    => now()
                ];
    
                $latter_id = LetterModel::create($data_insert)->id;

                $files = [];

                foreach($request->file('document') as $file)

                {
                    $filename = Str::random(8).'.'.$file->extension();
                    $file->move('assets/document', $filename);  

                    $data_document[] = [
                        'latter_id'       => $latter_id,
                        'document'        => $filename,
                        'name'            => 'document surat masuk id:'.$latter_id
                    ];
    
                }

                DocumentModel::insert($data_document);


                DB::commit();

                Toastr::success('Arsip berhasil disimpan');
                return back();
            }
            catch(Exception $e)
            {
                DB::rollback();

                Toastr::error('Oops, Terjadi kesalahan, Arsip gagal disimpan');
                
                return back();
            }

        
        
    }

    public function update_surat(Request $request)
    {
        DB::beginTransaction();
            try
            {
                
                $data_update = [
                    'no_agenda'     => $request->no_agenda,
                    'pengirim'      => $request->pengirim,
                    'notes'         => $request->notes,
                    'no_surat'      => $request->no_surat,
                    'tgl_surat'     => $request->tgl_surat,
                    'tgl_dikirim'   => $request->tgl_dikirim,
                    'user_id'       => Auth::user()->id
                ];
    
                LetterModel::where('id', $request->letter_id)->update($data_update);

                
                if($request->document)
                {
                    $files = [];

                    foreach($request->file('document') as $file)

                    {
                        $filename = Str::random(8).'.'.$file->extension();
                        $file->move('assets/document', $filename);  
    
                        $data_document[] = [
                            'latter_id'       => $request->letter_id,
                            'document'        => $filename,
                            'name'            => 'document surat masuk id:'.$request->letter_id
                        ];
        
                    }
    
                    DocumentModel::insert($data_document);
                }
                

                DB::commit();

                Toastr::success('Arsip berhasil diupdate');
                return back();
            }
            catch(Exception $e)
            {
                DB::rollback();

                Toastr::error('Oops, Terjadi kesalahan, Arsip gagal diupdate');
                
                return back();
            }

        
        
    }

    public function delete_surat($slack)
    {
        $delete = LetterModel::where('slack', $slack)->delete();

        if($delete){
            Toastr::success('File dihapus');
            return back();
        }else{
            Toastr::error('File gagal dihapus');
            return back();
        }
    }

    public function delete_document_surat($slack)
    {
        $delete = DocumentModel::where('document', $slack)->delete();

        if($delete){
            Toastr::success('File dihapus');
            return back();
        }else{
            Toastr::error('File gagal dihapus');
            return back();
        }
    }

    public function laporan_surat_masuk()
    {
        $data = [
            'page'  => 'Surat Masuk',
            'item'  => LetterModel::where('category', 'in')->with('user')->get(),
            'type'  => 'in'
        ];

        return view('letter.laporan_surat', compact('data'));
    }

    public function laporan_surat_keluar()
    {
        $data = [
            'page'  => 'Surat Keluar',
            'item'  => LetterModel::where('category', 'out')->with('user')->get(),
            'type'  => 'out'
        ];

        return view('letter.laporan_surat', compact('data'));
    }

    public function print_laporan(Request $request)
    {
        $dateString = $request->date; // Misalnya '1997-01'

        // Membuat objek DateTime dari string dengan format 'Y-m'
        $date = \DateTime::createFromFormat('Y-m', $dateString);
        $year = $date->format('Y');
        $month = $date->format('m');

        $data['year'] = $year;
        $data['month'] =  $date->format('F');

        $data['surat'] = LetterModel::where('category', $request->type)
                            ->whereMonth('created_at', $month)
                            ->whereYear('created_at', $year)
                            ->get();
        if($request->type === 'in'){
            $data['type'] = 'SURAT MASUK';
        }else{
            $data['type'] = 'SURAT KELUAR';
        }

        $html = view('letter.pdf-laporan', compact('data'))->render();
        $config = [
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'default_font'  => 'arial',
            'margin_left'   => 10,
            'margin_right'  => 10,
            'margin_top'    => 5,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10,
        ];
                // Generate PDF
                $pdf = PDF::loadHTML($html, $config);
                return $pdf->stream('document.pdf', ['Attachment' => false]);
        
    }
}
