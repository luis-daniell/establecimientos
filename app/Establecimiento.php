<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    //

    protected $fillable = [
        'nombre',
        'categoria_id',
        'imagen_principal',
        'direccion',
        'colonia',
        'lat',
        'lng',
        'telefono',
        'descripcion',
        'apertura',
        'cierre',
        'uuid',
        // Esto lo requiere si se utiliza el metodo mas corto }
        // Que es el de importar la cla se de establecimiento
        'user_id'
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }


}
