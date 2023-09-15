<?php

namespace App\Http\Controllers;

use App\Models\NavigationSetting;
use Illuminate\Http\Request;
use App\Models\Navigation;
use Session;

class NavigationController extends Controller
{
    public function index()
    {
        return view('navigation.index', [
            'locations' => NavigationSetting::getData('LOCATION'),
            'types' => NavigationSetting::getData('TYPE'),
            'externals' => NavigationSetting::getData('EXTERNAL'),
            'ddMenus' => Navigation::getDragDropMenu(Navigation::getMenuItems())
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'type_id' => 'required',
            'menu_name' => 'required',
            'menu_link' => 'required',
        ]);

        Navigation::create($request->post());
        return redirect()->route('navigations.index')->with('success', 'Menu has been created successfully.');
    }

    public function ChangeStatus(Request $request)
    {
        $data = $request->all();
        $menu = Navigation::findOrFail($request->id);
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
        $item = Navigation::findOrFail($request->id);
        $item->update($data);
        return redirect()->back();
    }

    public function edit(Navigation $menu)
    {
        return view('nav.edit', [
            'menu' => $menu,
            'locations' => NavigationSetting::getData('LOCATION'),
            'types' => NavigationSetting::getData('TYPE')
        ]);
    }

    public function edit_menu($id)
    {
        $menus = Navigation::find($id);
        return response()->json([
            'status' => 200,
            'menus' => $menus,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request); exit;
        $menu_id = $request->input('id');
        $menus = Navigation::find($menu_id);
        $menus->id = $request->input('id');
        $menus->location_id = $request->input('location_id');
        $menus->type_id = $request->input('type_id');
        $menus->menu_name = $request->input('menu_name');
        $menus->menu_link = $request->input('menu_link');
        $menus->external_link = $request->input('external_link');
        $menus->new_tab = $request->input('new_tab');
        $menus->update();
        return redirect()->route('navigations.index')->with('success', 'Menu has been updated successfully.');
    }


    public function edit_order(Request $request)
    {
        $req = $request->all();
        $json_data = $request->input('data');
        $data = json_decode($json_data);
        $readbleArray = Navigation::parseJsonArray($data);
        $i = 0;
        foreach ($readbleArray as $row) {
            $i++;
            $menu = Navigation::findOrFail($row['id']);
            $datas['parent'] = $row['parentID'];
            $datas['ordering'] = $i;
            $menu->update($datas);
        }
    }

    public function destroy(Request $request)
    {
        Navigation::findOrFail($request->id)->delete();
        return redirect('navigations')->with('success', 'Menu has been deleted successfully');
    }

}
