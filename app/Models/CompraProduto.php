<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProduto extends Model
{
    use HasFactory;

    protected $fillable = ['compra_id', 'produto_id', 'valor', 'data'];

    /**
     * Relacionamento com o modelo Compra.
     */
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    /**
     * Relacionamento com o modelo Produto.
     */
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}