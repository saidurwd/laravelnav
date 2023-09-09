<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

//    protected $table = 'menus';
//    protected $primaryKey = 'id';
    protected $fillable = ['location_id', 'type_id', 'menu_name', 'menu_link', 'new_tab', 'status', 'created_at', 'updated_at'];
}

