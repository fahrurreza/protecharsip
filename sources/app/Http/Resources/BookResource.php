<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category as CategoryModel;
use App\Models\Rak as RakModel;

class BookResource extends JsonResource
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
            'category_id' => $this->category_id,
            'rak_id' => $this->rak_id,
            'category_name' =>  $this->category->category_name,
            'rak_name' =>  $this->rak->rak_name,
            'stock' => $this->stock->stock,
            'book_name' => $this->book_name,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
        ];
    }
}
