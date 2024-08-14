<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'valor', 'pontos'];

    /**
     * Relacionamento com o modelo CompraProduto.
     */
    public function compraProdutos()
    {
        return $this->hasMany(CompraProduto::class);
    }
}