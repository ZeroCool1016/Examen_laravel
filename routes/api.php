<?php

use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//ROLES Y PERMISOS
Route::get('/permisosRoles',[RolesController::class,'roles_permisos']);
//BUSCAR ROLES POR ID
Route::get('/searchRol/{id}',[RolesController::class,'search_roles']);
//ELIMINAR ROL
Route::delete('/deleteRol/{id}',[RolesController::class,'delete_rol']);
//ACTUALIZAR UN ROL
Route::put('updateRol/{id}', [RolesController::class,'update_roles']);
