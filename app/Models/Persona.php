<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'apellido',
        'mail',
        'mensaje'


    ];
}
