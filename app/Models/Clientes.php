<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clientes extends Model
{
    public function planes(): BelongsTo
    {
        return $this->belongsTo(Planes::class);
    }

    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripciones::class);
    }
}
