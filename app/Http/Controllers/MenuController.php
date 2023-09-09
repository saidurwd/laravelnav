<?php

namespace App\Http\Controllers;

use App\Models\MenuSetting;
use Illuminate\Http\Request;
use App\Models\Menu;
//use Session;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu', [
            'locations' => MenuSetting::where('type', 'LOCATION')->get(),
            'types' => MenuSetting::where('type', 'TYPE')->get()
            ]);
    }

}
