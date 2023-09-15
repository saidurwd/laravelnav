<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    use HasFactory;

//    protected $table = 'navigations';
//    protected $primaryKey = 'id';
    protected $fillable = ['parent', 'user_id','location_id', 'type_id', 'menu_name', 'menu_link', 'new_tab', 'status', 'external_link','ordering', 'created_at', 'updated_at'];

    public static function getStatus($id)
    {
        $menu = Navigation::where('id', $id)->first();
        if ($menu->status == 'Active') {
            return '<a href="change-status/' . $menu->id . '" class="btn btn-light btn-sm active" title="Active"><i class="fa fa-eye"></i></a> <span class="text-uppercase ms-2">';
        } else {
            return '<a href="change-status/' . $menu->id . '" class="btn btn-light btn-sm inactive" title="Inactive"><i class="fa fa-eye-slash"></i></a> <span class="text-uppercase ms-2">';
        }

    }

    public static function getMenuItems()
    {
        $query = Navigation::orderBy("ordering", "ASC")->get();
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
//        $items = Navigation::getMenuItems();
        $html = "<ol class=\"" . $class . "\" id=\"menu-id\">";
        foreach ($items as $key => $value) {
            $html .= '<li class="dd-item dd3-item" data-id="' . $value['id'] . '" >
                    <div class="row mt-1 shadow-none p-1 bg-light rounded">
                        <div class="col-sm-4">
                            <span class="dd-handle dd3-handle"><i class="fa-solid fa-grip-vertical"></i></span> <span id="label_show' . $value['id'] . '">' . $value['menu_name'] . '</span>
                            <p class="text-secondary mx-3"><span id="link_show' . $value['id'] . '">' . $value['menu_link'] . '</span></p>
                        </div>
                        <div class="col-sm-6">
                            ' . Navigation::getStatus($value['id']) . '<span class="text-uppercase">' . $value['menu_name'] . '</span>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-outline-warning btn-sm EditMenuModal" value="'.$value['id'].'"><i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm DeleteMenuModal" value="' . $value['id'] . '"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>';
            if (array_key_exists('child', $value)) {
                $html .= Navigation::getDragDropMenu($value['child'], 'child');
            }
            $html .= "</li>";
        }
        $html .= "</ol>";
        return $html;
    }

    public static function parseJsonArray($jsonArray, $parentID = 0)
    {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = Navigation::parseJsonArray($subArray->children, $subArray->id);
            }

            $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

}

