<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return redirect('/menus');
});
Route::resource('menus', MenuController::class);
Route::controller(MenuController::class)->group(function () {
    Route::get('menus/statusupdate/{id}', 'ChangeStatus');
    Route::get('menus/find-menu/{id}', function (Request $request, $id) {
        return $id;
    });
    Route::get('menus/delete-menu/{id}', 'DeleteMenu');
    Route::post('menus/edit-order', 'edit_order');
});
Route::resource('companies', CompanyController::class);

