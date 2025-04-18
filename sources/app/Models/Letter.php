<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function document()
    {
        return $this->hasMany(Document::class, 'latter_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
