<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table ="file_letter";
    protected $guarded = ['id'];
    public $timestamps = false;
}
