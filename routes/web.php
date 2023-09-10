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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controller(MenuController::class)->group(function () {
    Route::get('menu', 'Index');
    Route::get('create', 'CreateMenu');
    Route::get('statusupdate/{id}', 'ChangeStatus');
    Route::get('/find-menu/{id}', function (Request $request, $id) {
        return $id;
    });
    Route::get('edit-menu/{id}', 'EditMenu');
    Route::get('delete-menu/{id}', 'DeleteMenu');
});

Route::resource('companies', CompanyController::class);
