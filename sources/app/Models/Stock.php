<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
