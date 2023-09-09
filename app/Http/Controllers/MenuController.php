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
//            'menus' =>  Menu::where([['status', 'Active'], ['parent', 0]])->orderBy("ordering", "ASC")->get(),
            'menus' => Menu::getMenu(),
            'locations' => MenuSetting::getData('LOCATION'),
            'types' => MenuSetting::getData('TYPE')
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
