<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id')->where('parent_id',0);
    }

    public function children()
    {
        return $this->hasMany(Menu::class,'parent_id')->with('subchildren')->orderBy('short_order', 'ASC');
    }

    public function subchildren()
    {
        return $this->hasMany(Menu::class,'parent_id')->orderBy('short_order', 'ASC');
    }
}
