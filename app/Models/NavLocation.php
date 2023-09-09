<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavLocation extends Model
{
    use HasFactory;
    protected $table = 'nav_location';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
}
