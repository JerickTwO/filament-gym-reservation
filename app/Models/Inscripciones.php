<?php

namespace App\Models;
use App\Models\Clientes;
use App\Models\Planes;

use Illuminate\Database\Eloquent\Model;

class Inscripciones extends Model
{
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }
    
    public function planes()
    {
        return $this->belongsTo(Planes::class, 'planes_id');
    }
    
}
