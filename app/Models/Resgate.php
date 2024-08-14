<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resgate extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'premio', 'pontos_gastos', 'data'];

    /**
     * Relacionamento com o modelo Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}