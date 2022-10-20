<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_roles extends Model
{
    public $timestamps =false;
    protected $table = 'cat_roles';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['id_rol', 'nombre_rol', 'activo'];
}
