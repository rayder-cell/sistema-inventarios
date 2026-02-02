<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    /** @use HasFactory<\Database\Factories\SucursalFactory> */
    use HasFactory;

    protected $table = 'sucursales';
    protected $fillable = ['nombre', 'direccion', 'telefono', 'activo'];

    public function inventarioSucuralLotes()
    {
        return $this->hasMany(InventarioSucuralLote::class);
    }
    public function movimientosInventarios()
    {
        return $this->hasMany(MovimientoInventario::class);
    }
}
