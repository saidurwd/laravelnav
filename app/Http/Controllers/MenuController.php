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

    public function ChangeStatus(Request $request)
    {
        $data = $request->all();
        $menu = Menu::findOrFail($request->id);
        if ($menu->status == "Active") {
            $data['status'] = 'Inactive';
        } else {
            $data['status'] = 'Active';
        }
        $menu->update($data);
        return redirect()->back();
    }

    public function EditMenu(Request $request)
    {
        $data = $request->all();
        $item = Menu::findOrFail($request->id);
        $item->update($data);
        return redirect()->back();
    }

    public function DeleteMenu(Request $request)
    {
        Menu::findOrFail($request->id)->delete();
        return redirect('menu')->with('success', 'Menu deleted successfully');
    }

}
