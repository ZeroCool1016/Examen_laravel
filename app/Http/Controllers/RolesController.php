<?php

namespace App\Http\Controllers;

use App\Models\cat_permiso;
use App\Models\cat_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function roles_permisos(){
        $registros = array();
        $roles = cat_roles::all();

        foreach ($roles as $item) {
            $id_rol= $item->id_rol;
            $permisos = DB::table('cat_permisos')
            ->select('visualizar','actualizar','eliminar','crear')
            ->where('id_rol','=',$id_rol)
            ->get();
            if($permisos != null){
                $registros[] = array(
                    "id_rol"=>$id_rol,
                    "nombre_rol"=>$item->nombre_rol,
                    "permisos"=>$permisos
                );
            }
        }
        return response()->json($registros, 200);
    }
    public function search_roles($id){
        $rol = cat_roles::find($id);
        
        if($rol != null){
            $permisos = cat_permiso::select('visualizar','actualizar','eliminar','crear')
            ->where('id_rol','=',$id)
            ->get();
            if($permisos != null){
                $response = array(
                    "id_rol"=>$rol->id_rol,
                    "nombre_rol"=>$rol->nombre_rol,
                    "permisos"=>$permisos
                    );
                    return response()->json($response, 200);
            }else{
                $texto = 'Permisos no encontrados';
                return response()->json($texto, 400,);
            }
        }else{
            $texto = 'Rol no encontrado';
            return response()->json($texto, 400,);
        }

    }
    public function delete_rol($id){
        $registros = cat_roles::find($id);
        if($registros != null){
            cat_permiso::where('id_rol','=',$id)
            ->delete();
            cat_roles::where('id_rol','=',$id)
            ->delete();
            return response()->json('El rol se a eliminado con exito', 200);
        }else{
            $texto = 'Rol no encontrado';
            return response()->json($texto, 400,);
        }
    }
    public function update_roles(Request $request ,$id){
        $rol = cat_roles::where('id_rol','=',$id)->get();
        if($rol != null){
            DB::select(
                'UPDATE `examen_laravel`.`cat_permisos`
                SET `visualizar` = ?, `actualizar` = ?, `eliminar` = ?, `crear` = ?
                WHERE (`id_permiso` = ?)'
                ,[$request->visualizar,$request->actualizar,$request->eliminar,$request->crear,$id]);
            return response()->json('Rol actualizado', 200 );
        }else{
            return response()->json('No se a encontrado el rol especificado', 400);
        }
    }
}
