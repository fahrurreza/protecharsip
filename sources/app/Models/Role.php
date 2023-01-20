<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsToMany(Menu::class)->with(['children', 'subchildren'])->where('parent_id', 0)->orderBy('short_order', 'ASC');
    }
}
