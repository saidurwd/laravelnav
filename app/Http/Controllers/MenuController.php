<?php

namespace App\Http\Controllers;

use App\Models\MenuSetting;
use Illuminate\Http\Request;
use App\Models\Menu;
use Session;

class MenuController extends Controller
{
    public function index()
    {
        return view('nav.index', [
            'menus' => Menu::getMenu(),
            'locations' => MenuSetting::getData('LOCATION'),
            'types' => MenuSetting::getData('TYPE'),
            'ddMenus' => Menu::getDragDropMenu(Menu::getMenuItems())
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

        Menu::create($request->post());
        return redirect()->route('menus.index')->with('success', 'Menu has been created successfully.');
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

    public function edit(Menu $menu)
    {
//        return view('nav.edit', compact('menu'));
        return view('nav.edit', [
            'menu' => $menu,
            'locations' => MenuSetting::getData('LOCATION'),
            'types' => MenuSetting::getData('TYPE')
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'location_id' => 'required',
            'type_id' => 'required',
            'menu_name' => 'required',
            'menu_link' => 'required',
        ]);

        $menu->fill($request->post())->save();
        return redirect()->route('menus.index')->with('success', 'Menu has been updated successfully');
    }

    public function edit_order(Request $request)
    {
        $req = $request->all();
        $json_data = $request->input('data');
        $data = json_decode($json_data);
        $readbleArray = Menu::parseJsonArray($data);
        $i = 0;
        foreach ($readbleArray as $row) {
            $i++;
            $menu = Menu::findOrFail($row['id']);
            $datas['parent'] = $row['parentID'];
            $datas['ordering'] = $i;
            $menu->update($datas);
//            $db->exec("update menus set parent = '".$row['parentID']. "', ordering = '".$i."' where id = '".$row['id']."' ");
        }
    }

    public function DeleteMenu(Request $request)
    {
        Menu::findOrFail($request->id)->delete();
        return redirect('menus')->with('success', 'Menu has been deleted successfully');
    }

}
