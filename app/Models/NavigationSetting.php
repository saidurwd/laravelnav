<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavigationSetting extends Model
{
    use HasFactory;

//    protected $table = 'navigation_settings';
//    protected $primaryKey = 'id';
    protected $fillable = ['type', 'title', 'created_at', 'updated_at'];

    public static function getData($type){
        return NavigationSetting::where('type', $type)->get();
    }
}
