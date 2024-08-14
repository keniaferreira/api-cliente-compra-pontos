<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'data'];

    /**
     * Relacionamento com o modelo Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento com o modelo CompraProduto.
     */
    public function compraProdutos()
    {
        return $this->hasMany(CompraProduto::class);
    }
}