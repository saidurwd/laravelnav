<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Menuitem;

class FrontController extends Controller
{
    public function __construct()
    {
        $topNav = menu::where('location', 1)->first();
        $topNavItems = json_decode($topNav->content);
        $topNavItems = $topNavItems[0];
        foreach ($topNavItems as $menu) {
            $menu->title = Menuitem::where('id', $menu->id)->value('title');
            $menu->name = Menuitem::where('id', $menu->id)->value('name');
            $menu->slug = Menuitem::where('id', $menu->id)->value('slug');
            $menu->target = Menuitem::where('id', $menu->id)->value('target');
            $menu->type = Menuitem::where('id', $menu->id)->value('type');
            if (!empty($menu->children[0])) {
                foreach ($menu->children[0] as $child) {
                    $child->title = Menuitem::where('id', $child->id)->value('title');
                    $child->name = Menuitem::where('id', $child->id)->value('name');
                    $child->slug = Menuitem::where('id', $child->id)->value('slug');
                    $child->target = Menuitem::where('id', $child->id)->value('target');
                    $child->type = Menuitem::where('id', $child->id)->value('type');
                }
            }
        }
        view()->share([
            'topNavItems' => $topNavItems,
        ]);
    }

    public function index()
    {
        return view('frontend.index');
    }
}
