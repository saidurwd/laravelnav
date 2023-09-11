<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

//    protected $table = 'menus';
//    protected $primaryKey = 'id';
    protected $fillable = ['parent', 'location_id', 'type_id', 'menu_name', 'menu_link', 'new_tab', 'status', 'ordering', 'created_at', 'updated_at'];

    public static function getMenu($id = 0)
    {
        $menus = Menu::where([['parent', $id]])->orderBy("ordering", "ASC")->get();
        $data = null;
        if (count($menus) > 0) {
            foreach ($menus as $menu) {
                $data .= '<div class="row mt-3">';
                $data .= '	<div class="col-sm-4">';
                $data .= '		<i class="fa-solid fa-grip-vertical"></i> ' . $menu->menu_name;
                $data .= '		<p class="text-secondary ms-3">' . $menu->menu_link . '</p>';
                $data .= '	</div>';
                $data .= '	<div class="col-sm-6">';
                $data .= Menu::getStatus($menu->id) . '<span class="text-uppercase ms-2">' . $menu->menu_name . '</span>';
                $data .= '	</div>';
                $data .= '	<div class="col-sm-2">';
                $data .= '<a class="btn btn-outline-warning btn-sm EditMenuModal" href="menus/' . $menu->id . '/edit"><i class="fa fa-pencil"></i></a>';
//                $data .= '		<button type="button" class="btn btn-outline-warning btn-sm EditMenuModal" value="' . $menu->id . '"><i class="fa fa-pencil"></i>';
//                $data .= '		</button>';
//                $data .= '<a class="btn btn-outline-warning btn-sm EditMenuModal" href="menus/'.$menu->id.'/edit"><i class="fa fa-pencil"></i></a>';
                $data .= '		<button type="button" class="btn btn-outline-danger btn-sm DeleteMenuModal" value="' . $menu->id . '"><i class="fa fa-trash"></i>';
                $data .= '		</button>';
                $data .= '	</div>';
                $data .= '</div>';
                $submenus = Menu::where([['parent', $menu->id]])->orderBy("ordering", "ASC")->get();
                if (count($submenus) > 0) {
                    foreach ($submenus as $submenu) {
                        $data .= '<div class="row mt-3">';
                        $data .= '	<div class="col-sm-4">';
                        $data .= '		<i class="fa-solid fa-grip-vertical ms-3"></i> ' . $submenu->menu_name;
                        $data .= '		<p class="text-secondary ms-4">' . $submenu->menu_link . '</p>';
                        $data .= '	</div>';
                        $data .= '	<div class="col-sm-6">';
                        $data .= Menu::getStatus($submenu->id) . '<span class="text-uppercase ms-2">' . $submenu->menu_name . '</span>';
                        $data .= '	</div>';
                        $data .= '	<div class="col-sm-2">';
                        $data .= '		<button type="button" class="btn btn-outline-warning btn-sm EditMenuModal" value="' . $menu->id . '"><i class="fa fa-pencil"></i>';
                        $data .= '		</button>';
//                        $data .= '<a class="btn btn-outline-warning btn-sm EditMenuModal" href="menus/'.$submenu->id.'/edit"><i class="fa fa-pencil"></i></a>';
                        $data .= '		<button type="button" class="btn btn-outline-danger btn-sm DeleteMenuModal" value="' . $submenu->id . '"><i class="fa fa-trash"></i>';
                        $data .= '		</button>';
                        $data .= '	</div>';
                        $data .= '</div>';
                    }
                }
            }
        }
        return $data;
    }

    public static function getStatus($id)
    {
        $menu = Menu::where('id', $id)->first();
        if ($menu->status == 'Active') {
            return '<a href="statusupdate/' . $menu->id . '" class="btn btn-light btn-sm active" title="Active"><i class="fa fa-eye"></i></a> <span class="text-uppercase ms-2">';
        } else {
            return '<a href="statusupdate/' . $menu->id . '" class="btn btn-light btn-sm inactive" title="Inactive"><i class="fa fa-eye-slash"></i></a> <span class="text-uppercase ms-2">';
        }

    }

    public static function getMenuItems()
    {
        $query = Menu::orderBy("ordering", "ASC")->get();
        $ref = [];
        $items = [];
        foreach ($query as $data) {
            $thisRef = &$ref[$data->id];
            $thisRef['parent'] = $data->parent;
            $thisRef['menu_name'] = $data->menu_name;
            $thisRef['menu_link'] = $data->menu_link;
            $thisRef['id'] = $data->id;
            if ($data->parent == 0) {
                $items[$data->id] = &$thisRef;
            } else {
                $ref[$data->parent]['child'][$data->id] = &$thisRef;
            }
        }
        return $items;
    }

    public static function getDragDropMenu($items, $class = 'dd-list')
    {
//        $items = Menu::getMenuItems();
        $html = "<ol class=\"" . $class . "\" id=\"menu-id\">";
        foreach ($items as $key => $value) {
            $html .= '<li class="dd-item dd3-item" data-id="' . $value['id'] . '" >
                    <div class="row mt-1 shadow-none p-1 bg-light rounded">
                        <div class="col-sm-4">
                            <span class="dd-handle dd3-handle"><i class="fa-solid fa-grip-vertical"></i></span> <span id="label_show' . $value['id'] . '">' . $value['menu_name'] . '</span>
                            <p class="text-secondary mx-3"><span id="link_show' . $value['id'] . '">' . $value['menu_link'] . '</span></p>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-eye"></i> <span class="text-uppercase">' . $value['menu_name'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-outline-warning btn-sm EditMenuModal" value="' . $value['id'] . '"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm DeleteMenuModal" value="' . $value['id'] . '"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>';
            if (array_key_exists('child', $value)) {
                $html .= Menu::getDragDropMenu($value['child'], 'child');
            }
            $html .= "</li>";
        }
        $html .= "</ol>";
        return $html;
    }

}

