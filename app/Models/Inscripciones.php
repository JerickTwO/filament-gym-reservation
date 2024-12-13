<?php

namespace App\Models;
use App\Models\Clientes;
use App\Models\Planes;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'planes_id',
        'user_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'metodo_pago',
        'monto_pagado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function planes()
    {
        return $this->belongsTo(Planes::class, '
        ');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
