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
        $menus = Menu::where([['status', 'Active'], ['parent', $id]])->orderBy("ordering", "ASC")->get();
        $data = null;
        if (count($menus) > 0) {
            foreach ($menus as $menu) {
                $data .= '<div class="row mt-3">';
                $data .= '	<div class="col-sm-4">';
                $data .= '		<i class="fa-solid fa-grip-vertical"></i> ' . $menu->menu_name;
                $data .= '		<p class="text-secondary ms-3">' . $menu->menu_link . '</p>';
                $data .= '	</div>';
                $data .= '	<div class="col-sm-6">';
                $data .= '		<i class="fa fa-eye"></i> <span class="text-uppercase">' . $menu->menu_name . '</span>';
                $data .= '	</div>';
                $data .= '	<div class="col-sm-2">';
                $data .= '		<button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>';
                $data .= '		</button>';
                $data .= '		<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i>';
                $data .= '		</button>';
                $data .= '	</div>';
                $data .= '</div>';
                $submenus = Menu::where([['status', 'Active'], ['parent', $menu->id]])->orderBy("ordering", "ASC")->get();
                if (count($submenus) > 0) {
                    foreach ($submenus as $submenu) {
                        $data .= '<div class="row mt-3">';
                        $data .= '	<div class="col-sm-4">';
                        $data .= '		<i class="fa-solid fa-grip-vertical ms-3"></i> ' . $submenu->menu_name;
                        $data .= '		<p class="text-secondary ms-4">' . $submenu->menu_link . '</p>';
                        $data .= '	</div>';
                        $data .= '	<div class="col-sm-6">';
                        $data .= '		<i class="fa fa-eye"></i> <span class="text-uppercase">' . $submenu->menu_name . '</span>';
                        $data .= '	</div>';
                        $data .= '	<div class="col-sm-2">';
                        $data .= '		<button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-pencil"></i>';
                        $data .= '		</button>';
                        $data .= '		<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i>';
                        $data .= '		</button>';
                        $data .= '	</div>';
                        $data .= '</div>';
                    }
                }
            }
        }
        return $data;
    }

}

