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
                $data .= '		<button type="button" class="btn btn-outline-warning btn-sm EditMenuModal" value="' . $menu->id . '"><i class="fa fa-pencil"></i>';
                $data .= '		</button>';
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
        if($menu->status=='Active'){
            return '<a href="statusupdate/'.$menu->id.'" class="btn btn-light btn-sm active" title="Active"><i class="fa fa-eye"></i></a> <span class="text-uppercase ms-2">';
        } else {
            return '<a href="statusupdate/'.$menu->id.'" class="btn btn-light btn-sm inactive" title="Inactive"><i class="fa fa-eye-slash"></i></a> <span class="text-uppercase ms-2">';
        }

    }

}

