<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ["nombre", "tipo", "producto", "ubicacion", "telefono", "mail", "cif", "observaciones", "latitud", "longitud", "activo", "ultima_bitacora"];

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class);
    }
}
