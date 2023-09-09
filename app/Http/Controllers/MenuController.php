<?php

namespace App\Http\Controllers;

use App\Models\MenuSetting;
use Illuminate\Http\Request;
use App\Models\Menu;
use Session;

class MenuController extends Controller
{
    public function Index()
    {
        return view('menu', [
            'menus' => Menu::where('status', 'Active')->get(),
            'locations' => MenuSetting::where('type', 'LOCATION')->get(),
            'types' => MenuSetting::where('type', 'TYPE')->get()
        ]);
    }

    public function CreateMenu(Request $request)
    {
        $data = $request->all();
        if (Menu::create($data)) {
            $newdata = Menu::orderby('id', 'DESC')->first();
            session::flash('success', 'Menu saved successfully !');
            return redirect("menu");
        } else {
            return redirect()->back()->with('error', 'Failed to save Menu !');
        }
    }


}
