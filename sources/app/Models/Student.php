<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class)->where('status', 1)->with('book');
    }

    public function kembalian()
    {
        return $this->hasMany(Pinjaman::class)->where('status', 0)->with('book');
    }
}
