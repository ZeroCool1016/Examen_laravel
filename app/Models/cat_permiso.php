<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_permiso extends Model
{
    public $timestamps =false;
    protected $table = 'cat_permisos';
    protected $primaryKey = 'id_permiso';
    protected $fillable = ['id_permiso', 'id_rol', 'visualizar','actualizar','eliminar','crear'];
}
