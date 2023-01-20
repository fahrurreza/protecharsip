<?php

namespace App\Models;
use \Auth;

use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    protected $table ="menu_role";

    public function menu()
    {
        return $this->belongsTo(Menu::class)->with('children')->where('parent_id', 0);
    }
}
