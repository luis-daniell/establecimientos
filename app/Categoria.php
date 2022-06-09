<?php

namespace App;

use App\Establecimiento;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    //Leer las categorias por el slug
    public function getRouteKeyName()
    {
        return 'slug';
    }


    //Relación 1:n para categorias y establecimientos
    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }



}
