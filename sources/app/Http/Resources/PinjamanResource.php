<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PinjamanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'book_id' => $this->book_id,
            'student_id' => $this->student_id,
            'book_name' =>  $this->book->book_name,
            'student_name' =>  $this->student->nama_siswa,
            'jumlah' => $this->jumlah,
            'tanggal_dipinjam' => $this->tanggal_dipinjam,
            'batas_dipinjam' => $this->batas_dipinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
