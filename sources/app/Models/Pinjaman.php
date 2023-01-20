<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table ="pinjaman";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
