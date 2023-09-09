<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSetting extends Model
{
    use HasFactory;

//    protected $table = 'menu_settings';
//    protected $primaryKey = 'id';
    protected $fillable = ['type', 'title', 'created_at', 'updated_at'];

    public static function getData($type){
        return MenuSetting::where('type', $type)->get();
    }
}
