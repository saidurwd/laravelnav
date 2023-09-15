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

// returns the home page with all menus
Route::get('/navigations', NavigationController::class .'@index')->name('navigations.index');
// adds a menu to the database
Route::post('/create-nav', NavigationController::class .'@store')->name('create-nav');
// deletes a menu
Route::get('/find-nav/{id}', function (Request $request, $id) {return $id;});
Route::get('/delete-nav/{id}', NavigationController::class .'@destroy')->name('delete-nav');
// change menu status
Route::get('/change-status/{id}', NavigationController::class .'@ChangeStatus')->name('change-status');
// returns the form for editing a menu
Route::get('/update-menu/{id}', NavigationController::class .'@edit_menu')->name('update-menu');
// updates menu data
// Route::put('/store-menu/{id}', NavigationController::class .'@update')->name('store-menu');
Route::resource('/navigations', NavigationController::class);
// returns the form for adding a post
Route::post('/edit-order', NavigationController::class . '@edit_order')->name('edit-order');

// Route::get('navigations/update-menu/{id}', [NavigationController::class, 'edit_menu']);
// Route::put('navigations/store-menu/{id}', [NavigationController::class, 'update']);
// Route::controller(NavigationController::class)->group(function () {
//     Route::get('navigations/statusupdate/{id}', 'ChangeStatus');
//     Route::get('navigations/find-menu/{id}', function (Request $request, $id) {
//         return $id;
//     });
//     Route::get('navigations/delete-menu/{id}', 'DeleteMenu');
//     Route::post('navigations/edit-order', 'edit_order');
// });
Route::resource('companies', CompanyController::class);

