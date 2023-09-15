<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return redirect('/navigations');
});
Route::resource('navigations', NavigationController::class);
Route::get('navigations/update-menu/{id}', [NavigationController::class, 'edit_menu']);
Route::put('navigations/store-menu/{id}', [NavigationController::class, 'update']);
Route::controller(NavigationController::class)->group(function () {
    Route::get('navigations/statusupdate/{id}', 'ChangeStatus');
    Route::get('navigations/find-menu/{id}', function (Request $request, $id) {
        return $id;
    });
    Route::get('navigations/delete-menu/{id}', 'DeleteMenu');
    Route::post('navigations/edit-order', 'edit_order');
});
Route::resource('companies', CompanyController::class);
